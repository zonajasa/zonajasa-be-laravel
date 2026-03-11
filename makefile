#================= Docker Command Laravel and PHP Linux & Windows ================
zj-docker-start:
	docker compose -f docker-compose.yaml down
	docker compose -f docker-compose.yaml build app
	docker compose -f docker-compose.yaml up -d
#stop docker zonajasa
zj-docker-stop:
	docker compose -f docker-compose.yaml down
#list docker zonajasa
zj-docker-ps:
	docker compose -f docker-compose.yaml ps
#list docker images
zj-docker-image:
	docker image ls
#restart docker zonajasa
zj-docker-restart:
	docker compose -f docker-compose.yaml restart
#logs docker zonajasa
zj-docker-logs:
	docker compose -f docker-compose.yaml logs -f
#build docker zonajasa
zj-docker-build:
	docker compose -f docker-compose.yaml build app
zj-docker-migrate:
	docker compose -f docker-compose.yaml exec app php artisan migrate
	docker compose -f docker-compose.yaml exec app php artisan db:seed
zj-docker-rollback:
	docker compose -f docker-compose.yaml exec app php artisan migrate:rollback
#exec run migrate refresh
zj-docker-refresh:
	docker compose -f docker-compose.yaml exec app php artisan migrate:refresh
	docker compose -f docker-compose.yaml exec app php artisan db:seed
#exec run seeder
zj-docker-seed:
	docker compose -f docker-compose.yaml exec app php artisan db:seed
#exec app docker via composer install
zj-docker-composer-install:
	docker compose -f docker-compose.yaml exec app composer install
zj-docker-composer-update:
	docker compose -f docker-compose.yaml exec app composer update
zj-docker-php-m:
	docker compose -f docker-compose.yaml exec app php -m
zj-docker-dir-project:
	docker exec -it zonajasa bash
zj-docker-laravel-optimize-all:
	docker compose -f docker-compose.yaml exec app php artisan optimize
	docker compose -f docker-compose.yaml exec app php artisan cache:clear
	docker compose -f docker-compose.yaml exec app php artisan config:clear
	docker compose -f docker-compose.yaml exec app php artisan route:clear
	docker compose -f docker-compose.yaml exec app php artisan view:clear

#================= Docker Command Laravel and MAC ================
zj-mac-docker-start:
	docker compose -f docker-compose-mac.yaml down
	docker compose -f docker-compose-mac.yaml build app
	docker compose -f docker-compose-mac.yaml up -d
#stop docker zonajasa
zj-mac-docker-stop:
	docker compose -f docker-compose-mac.yaml down
#list docker zonajasa
zj-mac-docker-ps:
	docker compose -f docker-compose-mac.yaml ps
#list docker images
zj-mac-docker-image:
	docker image ls
#restart docker zonajasa
zj-mac-docker-restart:
	docker compose -f docker-compose-mac.yaml restart
#logs docker zonajasa
zj-mac-docker-logs:
	docker compose -f docker-compose-mac.yaml logs -f
#build docker zonajasa
zj-mac-docker-build:
	docker compose -f docker-compose-mac.yaml build app
zj-mac-docker-migrate:
	docker compose -f docker-compose-mac.yaml exec app php artisan migrate
	docker compose -f docker-compose-mac.yaml exec app php artisan db:seed
zj-mac-docker-rollback:
	docker compose -f docker-compose-mac.yaml exec app php artisan migrate:rollback
#exec run migrate refresh
zj-mac-docker-refresh:
	docker compose -f docker-compose-mac.yaml exec app php artisan migrate:refresh
	docker compose -f docker-compose-mac.yaml exec app php artisan db:seed
#exec run seeder
zj-mac-docker-seed:
	docker compose -f docker-compose-mac.yaml exec app php artisan db:seed
#exec app docker via composer install
zj-mac-docker-composer-install:
	docker compose -f docker-compose-mac.yaml exec app composer install
zj-mac-docker-composer-update:
	docker compose -f docker-compose-mac.yaml exec app composer update
zj-mac-docker-php-m:
	docker compose -f docker-compose-mac.yaml exec app php -m
zj-mac-docker-dir-project:
	docker exec -it zonajasa bash
zj-mac-docker-laravel-optimize-all:
	docker compose -f docker-compose-mac.yaml exec app php artisan optimize
	docker compose -f docker-compose-mac.yaml exec app php artisan cache:clear
	docker compose -f docker-compose-mac.yaml exec app php artisan config:clear
	docker compose -f docker-compose-mac.yaml exec app php artisan route:clear
	docker compose -f docker-compose-mac.yaml exec app php artisan view:clear

#================= Laravel and PHP Command =================
zj-start:
	php artisan serve
zj-octane:
	php artisan octane:start --server=swoole
zj-migrate:
	php artisan migrate
zj-rollback:
	php artisan migrate:rollback
zj-refresh:
	php artisan migrate:refresh
zj-seed:
	php artisan db:seed
zj-laravel-optimize-all:
	php artisan optimize
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
zj-job-lorawan:
	php artisan queue:work
zj-lorajob-start:
	while true; do php artisan schedule:run; done