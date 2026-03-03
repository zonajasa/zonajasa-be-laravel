zj-start:
	docker compose -f docker-compose.yml up -d
#stop docker haircut
zj-stop:
	docker compose -f docker-compose.yml down
#list docker haircut
zj-ps:
	docker compose -f docker-compose.yml ps
#list docker images
zj-image:
	docker image ls
#restart docker haircut
zj-restart:
	docker compose -f docker-compose.yml restart
#logs docker haircut
zj-logs:
	docker compose -f docker-compose.yml logs -f
#build docker haircut
zj-build:
	docker compose -f docker-compose.yml build dashboard

#================= Docker Command Laravel and PHP ================
zj-migrate:
	docker compose -f docker-compose.yml exec dashboard php artisan migrate
	docker compose -f docker-compose.yml exec dashboard php artisan db:seed
zj-rollback:
	docker compose -f docker-compose.yml exec dashboard php artisan migrate:rollback
#exec run migrate refresh
zj-refresh:
	docker compose -f docker-compose.yml exec dashboard php artisan migrate:refresh
	docker compose -f docker-compose.yml exec dashboard php artisan db:seed
#exec run seeder
zj-seed:
	docker compose -f docker-compose.yml exec dashboard php artisan db:seed
#exec app docker via composer install
zj-composer-install:
	docker compose -f docker-compose.yml exec dashboard composer install
zj-composer-update:
	docker compose -f docker-compose.yml exec dashboard composer update
zj-php-m:
	docker compose -f docker-compose.yml exec dashboard php -m
zj-dir-project:
	docker exec -it yotta-dashboard bash
zj-laravel-optimize-all:
	docker compose -f docker-compose.yml exec dashboard php artisan optimize
	docker compose -f docker-compose.yml exec dashboard php artisan cache:clear
	docker compose -f docker-compose.yml exec dashboard php artisan config:clear
	docker compose -f docker-compose.yml exec dashboard php artisan route:clear
	docker compose -f docker-compose.yml exec dashboard php artisan view:clear

sj-start:
	php artisan serve
sj-octane:
	php artisan octane:start --server=swoole
sj-migrate:
	php artisan migrate
sj-rollback:
	php artisan migrate:rollback
sj-refresh:
	php artisan migrate:refresh
sj-seed:
	php artisan db:seed
sj-laravel-optimize-all:
	php artisan optimize
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
sj-job-lorawan:
	php artisan queue:work
sj-lorajob-start:
	while true; do php artisan schedule:run; done