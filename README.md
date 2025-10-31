# MultiVendorHub - Sydney Signature Stores

![Laravel](https://img.shields.io/badge/Laravel-12.36.1-red)
![PHP](https://img.shields.io/badge/PHP-8.2.0-orange)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)
![Vite](https://img.shields.io/badge/Vite-7.1.11-green)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-blue)
![License](https://img.shields.io/badge/License-MIT-yellow)

---

## Project Overview

**MultiVendorHub** is a modern **multi-vendor e-commerce platform** where:

- **Sellers** can create their own stores
- **Buyers** can shop from multiple sellers in one place
- **Admin** has full control over users, stores, and orders

> **Live Demo:** [https://rehman.sydneysignaturelimos.com](https://rehman.sydneysignaturelimos.com)

---

## Key Features

| Role | Features |
|------|---------|
| **SuperAdmin** | Full access, manage users, stores, orders |
| **Admin** | manage users, stores, orders |
| **Seller** | Create store, add products, manage orders |
| **Buyer** | Browse, cart, checkout, track orders |
| **Emails** | Order confirmation, status updates (Mailtrap) |
| **Roles** |`0=SuperAdmin`, `1=Admin`, `2=Seller`, `3=Buyer` |

---

## Tech Stack

- **Backend:** Laravel 12 + PHP 8.2
- **Frontend:** Blade Templates + Tailwind CSS + Vite
- **Database:** MySQL
- **Queue:** Laravel Queue (database driver)
- **Email:** Mailtrap (SMTP)
- **Asset Build:** Vite + Laravel Vite Plugin

---

## Installation (Local Development)

### 1. Clone the Repository
```bash
git clone https://github.com/rehman-developers/MultiVendorHub.git
cd MultiVendorHub


2. Install Dependencies

composer install
npm install

3. Environment Setup

cp .env.example .env
php artisan key:generate

Configure .env

APP_NAME="Sydney Signature Stores"
APP_ENV=local
APP_URL=http://localhost:8000
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multivendorhub
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@multivendorhub.com
MAIL_FROM_NAME="Sydney Signature Stores"

QUEUE_CONNECTION=database

4. Run Migrations & Seed Data

php artisan migrate:fresh
php artisan db:seed

5. Build Frontend Assets
npm run build
# For development (hot reload):
# npm run dev

php artisan serve
Visit: http://localhost:8000

Production Deployment (VPS)

# 1. Pull latest code
git pull origin main

# 2. Install PHP & JS dependencies
composer install --optimize-autoloader --no-dev
npm ci

# 3. Build assets
npm run build

# 4. Run migrations
php artisan migrate --force

# 5. Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize:clear


Queue Setup (For Delayed Emails)
php artisan queue:table
php artisan migrate

Supervisor Configuration
# /etc/supervisor/conf.d/laravel-worker.conf
[program:laravel-worker]
process_name=%(program_name)s
command=php /home/sydneysi/rehman.sydneysignaturelimos.com/artisan queue:work --sleep=3 --tries=3
directory=/home/sydneysi/rehman.sydneysignaturelimos.com
autostart=true
autorestart=true
user=sydneysi
redirect_stderr=true
stdout_logfile=/home/sydneysi/rehman.sydneysignaturelimos.com/storage/logs/worker.log


sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker

Role-Based Routing

Role,Value,Dashboard Route
Admin,0,/admin/dashboard
Seller,1,/seller/dashboard
Buyer,2,/buyer/dashboard

Common Issues & Fixes

Issue,Solution
Vite manifest not found,Run npm run build
Column 'role' not found,Run php artisan migrate:fresh
Too many emails per second,Use queue + later() in mail sending
SMTP Connection refused,Use MAIL_PORT=587 + smtp.mailtrap.io
Page expired on logout,Ensure @csrf is in logout form

Contributing
Fork the repository
Create a feature branch: git checkout -b feature/name
Commit changes: git commit -m "Add feature"
Push to branch: git push origin feature/name
Open a Pull Request

> **Default Admin:**  
> Email: `super@admin.com`
> Password: `password123`

###  Start Server
```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## Role-Based Access

| Role | Value | Dashboard |
|------|-------|-----------|
| SuperAdmin | `0` | `/admin/dashboard` |
| Admin | `1` | `/admin/dashboard` |
| Seller | `2` | `/seller/dashboard` |
| Buyer | `3` | `/buyer/dashboard` |

---
