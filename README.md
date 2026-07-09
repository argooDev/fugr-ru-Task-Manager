# REST API для управления списком задач
Тестовое задание на позицию php разработчика - https://github.com/fugr-ru/php

# Стек
PHP 8.3 
Laravel 11
MySQL 8.0
Docker
Swagger

# Запуск
```bash
git clone https://github.com/argooDev/fugr-ru-Task-Manager.git
cd fugr-ru-Task-Manager
```

```bash
docker compose up -d
docker compose exec app php artisan migrate
```

Браузер/Postman - http://localhost:8081/api/tasks
Swagger - http://localhost:8081/api/documentation

```bash
# Тесты
docker compose exec app php artisan test
```

# Эндпоинты

| Метод | URL | Описание |
|-------|-----|----------|
| GET | `/api/tasks` | Список задач |
| POST | `/api/tasks` | Создать задачу |
| GET | `/api/tasks/{id}` | Получить задачу |
| PATCH | `/api/tasks/{id}` | Обновить задачу |
| DELETE | `/api/tasks/{id}` | Удалить задачу |

Параметры для `GET /api/tasks`:
- `search` — поиск по названию
- `sort` — сортировка (`deadline`, `created_at`, `id`, `title`)
- `per_page` — кол-во на странице