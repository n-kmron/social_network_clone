launch: config
	php artisan serve
config:
	cp .env.example .env
	composer install
	php artisan key:generate
	php artisan migrate --seed
