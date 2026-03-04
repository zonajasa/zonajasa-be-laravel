#================= Docker Command Laravel and PHP ================
zj-docker-start:
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

#================= Laravel and PHP Command =================
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