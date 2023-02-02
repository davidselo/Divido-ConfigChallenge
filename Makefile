KNOWN_COMMAND = run
ARGS := $(filter-out $(KNOWN_COMMAND),$(MAKECMDGOALS))

# Define available commands
.PHONY: start run tests build

# Variables
current_dir := $(shell pwd)
uid := $(shell id -u)
gid := $(shell id -g)

start:
	docker-compose up -d
run:
	docker-compose exec php-cli $(ARGS)
tests:
	docker-compose run phpunit
build:
	docker-compose build
	docker-compose run composer require --dev phpunit/phpunit

