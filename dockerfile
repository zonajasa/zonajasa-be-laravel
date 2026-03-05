FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install Composer# ...existing code...
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    zip \
    build-essential \
    autoconf \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo_mysql zip mbstring exif pcntl bcmath \
    && pecl install grpc swoole \
    && docker-php-ext-enable grpc swoole \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . .

# Copy .env file
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Install dependencies with dev packages (needed for Artisan commands)
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --prefer-dist --no-scripts

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Check database connection
RUN php artisan migrate --no-interaction --force 2>/dev/null || true

# Run database seeders
RUN php artisan db:seed --no-interaction --force 2>/dev/null || true

# Cache configuration and routes for optimization
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port 8085 for Octane server
EXPOSE 8085

# Start Laravel with Octane and Swoole
CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0", "--port=8085"]