.DEFAULT_GOAL := help

COMPOSE := docker compose

.PHONY: help up down logs build api-shell web-shell test api-qa web-check check hooks

help:
	@printf '%s\n' \
		'Wrenchbase development commands:' \
		'  make up         Build and start the development stack' \
		'  make down       Stop the development stack' \
		'  make logs       Follow service logs' \
		'  make api-shell  Open a shell in the API container' \
		'  make web-shell  Open a shell in the web container' \
		'  make test       Run the API test suite' \
		'  make api-qa     Run GrumPHP checks' \
		'  make web-check  Run frontend lint and type checks' \
		'  make check      Run all project checks' \
		'  make hooks      Enable the repository Git hooks'

up:
	$(COMPOSE) up --build --wait

down:
	$(COMPOSE) down

logs:
	$(COMPOSE) logs --follow

build:
	$(COMPOSE) build

api-shell:
	$(COMPOSE) exec api bash

web-shell:
	$(COMPOSE) exec web bash

test:
	$(COMPOSE) run --rm -T api composer test

api-qa:
	$(COMPOSE) run --rm -T --workdir /workspace/api api vendor/bin/grumphp run --no-interaction

web-check:
	$(COMPOSE) run --rm -T web npm run check

check: api-qa web-check

hooks:
	git config core.hooksPath .githooks
