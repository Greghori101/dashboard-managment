Dashboard Platform

This project is a full-stack web application built with Laravel 12 (API) and Nuxt 4 (Frontend).
The backend provides secure RESTful APIs using Laravel Sanctum for authentication, while the frontend is powered by Nuxt UI for modern, responsive components.

🚀 Tech Stack

Backend: Laravel 12, Sanctum, MySQL/MariaDB

Frontend: Nuxt 4, Nuxt UI, TailwindCSS

Auth: Laravel Sanctum (token-based API authentication)

Architecture: API-driven, SPA frontend consuming backend endpoints

⚙️ Setup Instructions
1. Backend (Laravel 12 API)
# Clone repository
git clone https://github.com/your-org/your-repo.git
cd your-repo/backend

# Install dependencies
composer install

# Copy env file
cp .env.example .env

# Configure .env with database + Sanctum
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dashboard_app
DB_USERNAME=your_user
DB_PASSWORD=your_pass

APP_FRONT_URL=http://localhost:3000

# Run migrations
php artisan migrate

# Start backend server
php artisan serve

2. Frontend (Nuxt 4)
cd ../frontend

# Install dependencies
npm install

# Create .env file
NUXT_PUBLIC_API_BASE=http://127.0.0.1:8000/api

# Run development server
npm run dev

🏗️ Architecture Choices
Separation of Concerns

Backend and frontend are decoupled. Laravel only exposes an API, while Nuxt handles the SPA.

Authentication with Sanctum

Chosen for:

Native Laravel support

SPA-friendly token authentication

Easy scaling for mobile and web clients

Nuxt UI + TailwindCSS

Ensures modern and responsive UI

Consistent widget/card styling

Rapid prototyping

Versioned Dashboards

Dashboards support multiple versions

Safe iteration without data loss

Widget System

Widgets rendered dynamically (WidgetLink, WidgetText, etc.)

Allows modular and composable dashboards

Scalability

API-first design supports web + mobile clients

# Laravel 12 + Nuxt 4 + MySQL (Dockerized)

## Setup

1. Clone the repository
git clone https://github.com/your/repo.git
cd repo

2. Create .env files

Run inside container once to generate the key:
```
docker-compose exec backend php artisan key:generate
```

3. Build and start containers
```
docker-compose up -d --build
```

4. Run migrations
```
docker-compose exec backend php artisan migrate --force
```

## Laravel migrations
docker-compose exec backend php artisan migrate

## Laravel seeders
docker-compose exec backend php artisan db:seed

## View logs
docker-compose logs -f backend
docker-compose logs -f frontend
docker-compose logs -f mysql

