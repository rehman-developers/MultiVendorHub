**`README.md`** – **GitHub ke liye MultiVendorHub Project**

```markdown
# MultiVendorHub - Sydney Signature Stores

![Laravel](https://img.shields.io/badge/Laravel-12.36.1-red)
![PHP](https://img.shields.io/badge/PHP-8.2.0-orange)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)
![Vite](https://img.shields.io/badge/Vite-7.1.11-green)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-blue)
![License](https://img.shields.io/badge/License-MIT-yellow)

---

## Project Overview

**MultiVendorHub** ek **modern multi-vendor e-commerce platform** hai jahan:
- **Sellers** apni stores bana sakte hain
- **Buyers** multiple sellers se products khareed sakte hain
- **Admin** sab kuch manage karta hai

> **Live Demo:** [https://rehman.sydneysignaturelimos.com](https://rehman.sydneysignaturelimos.com)

---

## Features

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
- **Frontend:** Blade + Tailwind CSS + Vite
- **Database:** MySQL
- **Queue:** Laravel Queue (database driver)
- **Email:** Mailtrap (SMTP)
- **Assets:** Vite + Laravel Vite Plugin

---

## Installation (Local / Development)

### 1. Clone Repository
```bash
git clone https://github.com/rehman-developers/MultiVendorHub.git
cd MultiVendorHub
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

#### `.env` Configuration
```env
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
MAIL_USERNAME=your4your5mailtrap6
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@multivendorhub.com
MAIL_FROM_NAME="Sydney Signature Stores"

QUEUE_CONNECTION=database
```

### 4. Run Migrations & Seed
```bash
php artisan migrate:fresh
php artisan db:seed
```

> **Default Admin:**  
> Email: `super@admin.com`
> Password: `password123`

### 5. Build Assets
```bash
npm run build
# or for dev
npm run dev
```

### 6. Start Server
```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## Production Deployment (VPS)

```bash
# 1. Git pull
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev
npm ci

# 3. Build assets
npm run build

# 4. Laravel setup
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize:clear

# 5. Queue worker (Supervisor)
sudo supervisorctl restart laravel-worker
```

---

## Queue Setup (Emails)

```bash
php artisan queue:table
php artisan migrate
```

**Supervisor Config:** `/etc/supervisor/conf.d/laravel-worker.conf`

```ini
[program:laravel-worker]
process_name=%(program_name)s
command=php /home/sydneysi/rehman.sydneysignaturelimos.com/artisan queue:work --sleep=3 --tries=3
directory=/home/sydneysi/rehman.sydneysignaturelimos.com
autostart=true
autorestart=true
user=sydneysi
stdout_logfile=/home/sydneysi/rehman.sydneysignaturelimos.com/storage/logs/worker.log
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker
```

---

## Role-Based Access

| Role | Value | Dashboard |
|------|-------|-----------|
| SuperAdmin | `0` | `/admin/dashboard` |
| Admin | `1` | `/admin/dashboard` |
| Seller | `2` | `/seller/dashboard` |
| Buyer | `3` | `/buyer/dashboard` |

---

## Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `super@admin.com` | `password123` |

---

## Troubleshooting

| Issue | Fix |
|------|-----|
| `Vite manifest not found` | `npm run build` |
| `Column 'role' not found` | `php artisan migrate:fresh` |
| `Too many emails per second` | Use `queue` + `later()` |
| `Connection refused` | Use `MAIL_PORT=587` + `smtp.mailtrap.io` |

---

## Contributing

1. Fork repo
2. Create branch: `git checkout -b feature/xyz`
3. Commit: `git commit -m "Add feature"`
4. Push: `git push origin feature/xyz`
5. Open Pull Request

---

---

**Sydney Signature Stores** – *Shop Local. Sell Global.*

---
```

**Done!** Ab repo professional lagega.

Chahte ho **screenshots** ya **demo video** bhi add karun?
