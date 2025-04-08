DOCKER_COMPOSE="$(shell which docker-compose)"
DOCKER="$(shell which docker)"
CONTAINER_PHP="app"

# Цвета
G=\033[32m
Y=\033[33m
NC=\033[0m


help: ## Список команд
	@grep -E '(^[a-zA-Z_0-9-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
	| awk 'BEGIN {FS = ":.*?## "}; {printf "${G}%-24s${NC} %s\n", $$1, $$2}' \
	| sed -e 's/\[32m## /[33m/' && printf "\n";

.PHONY: help



restart: down up ## Перезапуск контейнеров


up: ## Поднятие контейнеров
	${DOCKER_COMPOSE}  up --build -d

down: ## Остановка контейнеров
	${DOCKER_COMPOSE}  down --remove-orphans


.PHONY: restart  up down

bash: ## Войти в контейнер
	${DOCKER_COMPOSE} exec -it ${CONTAINER_PHP} /bin/bash

ps: ## Просмотр запущенных контейнеров
	${DOCKER_COMPOSE} ps

logs: ## Просмотр логов в контейнерах
	${DOCKER_COMPOSE} logs -f

right: ## Установка прав
	${DOCKER_COMPOSE} exec ${CONTAINER_PHP} chown -R www-data:www-data .

.PHONY:  bash ps logs right