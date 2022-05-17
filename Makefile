.PHONY: first-run prepare-env up down migrate migrate-rollback

first-run: prepare-env up composer-install migrate

prepare-env:
	cp .env.example .env

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

composer-install:
	./vendor/bin/sail composer install

migrate:
	./vendor/bin/sail artisan migrate

migrate-rollback:
	./vendor/bin/sail artisan migrate:rollback

test:
	./vendor/bin/sail test
