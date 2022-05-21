.PHONY: first-run prepare-env up down composer-install npm-install npm-run-dev build-frontend migrate migrate-rollback

first-run: prepare-env up composer-install generate-key migrate build-frontend

prepare-env:
	cp .env.example .env

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

composer-install:
	./vendor/bin/sail composer install

generate-key:
	./vendor/bin/sail artisan key:generate

npm-install:
	./vendor/bin/sail npm install

npm-run-dev:
	./vendor/bin/sail npm run dev

build-frontend: npm-install npm-run-dev

migrate:
	./vendor/bin/sail artisan migrate

migrate-rollback:
	./vendor/bin/sail artisan migrate:rollback

test:
	./vendor/bin/sail test
