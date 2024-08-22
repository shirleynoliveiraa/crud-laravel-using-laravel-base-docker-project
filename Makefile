setup:
	@make build
	@make up
	@make composer-update

build:
	echo "Building Docker containers..."
	docker-compose build --no-cache --force-rm

stop:
	echo "Stopping Docker containers..."
	docker-compose stop

up:
	echo "Starting Docker containers..."
	docker-compose up -d

composer-update:
	docker exec laravel-api bash -c "composer update"

data:
	docker exec laravel-api bash -c "php artisan migrate"
	docker exec laravel-api bash -c "php artisan db:seed"

setup-env:
	echo "Setting up environment file..."
	cp ./laravel-app/.env.example ./laravel-app/.env

clean:
	echo "Stopping and removing Docker containers, volumes, and networks..."
	docker-compose down -v --rmi all --remove-orphans
	sudo rm -rf ./laravel-app/storage/*
	sudo rm -rf ./laravel-app/bootstrap/cache/*
	sudo rm -rf ./laravel-app/vendor/*
	sudo rm -rf ./laravel-app/composer.lock

reset: clean setup