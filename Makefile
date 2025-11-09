.SILENT:

DC = docker compose run --rm php

all: dependencies lint test

.PHONY: shell sh
shell sh:
	${DC} sh

.PHONY: dependencies
dependencies:
	${DC} composer install --no-interaction

.PHONY: test
test: dependencies
	${DC} composer test

.PHONY: analyse
analyse: dependencies
	${DC} composer analyze

.PHONY: playground play
playground play:
	${DC} php /app/tests/playground.php

.PHONY: build
build:
	docker compose build

.PHONY: lint
lint:
	${DC} composer lint:show

.PHONY: lint-fix
lint-fix:
	${DC} composer lint:fix
