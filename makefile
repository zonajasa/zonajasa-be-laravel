#================= Docker Command Laravel and PHP Linux & Windows ================
zj-docker-start:
	# delegasikan logika platform/WAHA_IMAGE ke skrip terpisah supaya Makefile
	# tetap sederhana dan bebas error syntax.
	./compose-start.sh
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
	docker compose -f docker-compose.yaml exec app php artisan passport:keys --force
	docker compose -f docker-compose.yaml exec app php artisan passport:client --personal
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