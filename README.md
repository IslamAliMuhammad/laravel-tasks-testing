# Laravel Tasks App (with TDD)

A simple **Task Manager** built with Laravel to practice **Testing (Unit, Feature, Integration)** and **CI/CD with GitHub Actions**.

---

## 🚀 Features
- CRUD for tasks
- Ownership (users can only manage their tasks)
- Authentication with Laravel Breeze
- TDD (Test Driven Development)

---

## 📌 API Endpoints
- `GET /api/tasks` → list tasks

- `POST /api/tasks` → create task

- `PUT /api/tasks/{id}` → update task

- `DELETE /api/tasks/{id}` → delete task

---
## 🛠️ Setup

### Option 1: Local Setup (without Docker)

```bash
git clone https://github.com/IslamAliMuhammad/laravel-tasks-testing.git
cd laravel-tasks-testing
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Option 2: Docker Compose Setup (Recommended)

Make sure Docker and Docker Compose are installed, then run:

```bash
docker compose -f compose.dev.yaml up --build

docker exec -it php-fpm php artisan migrate --seed
```