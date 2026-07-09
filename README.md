Task Manager API

REST API для управления задачами.
Тестовое задание на позицию php разработчика — https://github.com/fugr-ru/php
Стек

    PHP 8.3

    Laravel 11

    MySQL 8.0

    Docker

    Swagger

Запуск
bash

docker-compose up -d
docker-compose exec app php artisan migrate

API: http://localhost:8081/api
Swagger: http://localhost:8081/api/documentation
Эндпоинты
Метод	URL	Описание
GET	/api/tasks	Список задач
POST	/api/tasks	Создать
GET	/api/tasks/{id}	Получить
PATCH	/api/tasks/{id}	Обновить
DELETE	/api/tasks/{id}	Удалить

Параметры для GET /api/tasks:

    search — поиск по названию

    sort — сортировка (deadline, created_at, id, title)

    per_page — кол-во на странице

Пример:
/api/tasks?search=купить&sort=deadline&per_page=5
Тесты
bash

docker-compose exec app php artisan test

Структура
text

app/
├── Http/Controllers/TaskController.php
├── Http/Requests/TaskRequest.php
├── Http/Resources/TaskResource.php
├── Models/Task.php
└── Services/Service.php

