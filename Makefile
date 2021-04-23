.DEFAULT_GOAL := help

UID := $(shell id -u)
GID := $(shell id -g)

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Build docker image
	docker build --build-arg UID=${UID} --build-arg GID=${GID} --tag d2-data-mapper .

up: build ## Start container
	docker run --rm -d --name d2-data-mapper -v $(PWD):/app --user ${UID}:${GID} d2-data-mapper

down: ## Start container
	docker stop d2-data-mapper

clean: ## Remove docker image
	docker stop d2-data-mapper; docker rmi -f d2-data-mapper

test-psalm: ## Run psalm tests
	docker exec d2-data-mapper /app/vendor/bin/psalm

test-phpunit: ## Run phpunit tests
	docker exec d2-data-mapper php /app/vendor/bin/phpunit

test-coverage: ## Run phpunit coverage tests
	docker exec d2-data-mapper php -dextension=xdebug.so -dxdebug.mode=coverage /app/vendor/bin/phpunit --colors=always --coverage-text --coverage-clover coverage.clover
	docker exec d2-data-mapper sed -i 's/\/app\/src/.\/src/' ./coverage.clover

shell: ## Shell of php container
	docker exec -ti --user ${UID}:${GID} d2-data-mapper /bin/sh
