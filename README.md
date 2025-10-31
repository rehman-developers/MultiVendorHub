<<<<<<< HEAD
# Laravel Practice Repository

This repository contains practical examples and implementations of various Laravel concepts across four folders. It serves as a learning resource for Laravel beginners, covering CRUD operations using Query Builder and Eloquent ORM, authentication, middlewares, routes, Blade templates, models, and controllers. The code is structured in separate folders for clarity, with step-by-step explanations below.

## Repository Structure
- **project-db**: Demonstrates CRUD operations using Laravel's Query Builder. Also covers basic concepts like routes, Blade templates, models, and controllers.
- **eloquent-orm**: Implements CRUD operations using Laravel's Eloquent ORM.
- **middleware**: Explores how middlewares work in Laravel, including custom middleware creation and usage.
- **authentication**: Covers user authentication, including registration, login, logout, and protected routes.

## Prerequisites
Before setting up the project, ensure you have the following installed:
- PHP 8.2 or higher
- Composer (dependency manager for PHP)
- MySQL or any other supported database (e.g., SQLite for development)
- Node.js and NPM (for asset compilation, if using Laravel Mix or Vite)
- Git (for cloning the repository)

## Setup Instructions (Step by Step)
Follow these steps to set up and run the projects locally. These instructions assume you're using a local development environment like XAMPP, WAMP, or Laravel Sail.

1. **Clone the Repository**:
   ```
   git clone https://github.com/rehman-developers/Laravel-Practice.git
   cd Laravel-Practice
   ```

2. **Install Dependencies**:
   Each folder is a separate Laravel project. Navigate to each folder (e.g., `cd project-db`) and run:
   ```
   composer install
   npm install
   ```

3. **Copy Environment File**:
   In each project folder, copy the `.env.example` file to `.env`:
   ```
   cp .env.example .env
   ```

4. **Generate Application Key**:
   ```
   php artisan key:generate
   ```

5. **Configure Database**:
   - Open `.env` and set your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name (e.g., laravel_practice)
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```
   - Create the database in MySQL (using phpMyAdmin or command line):
     ```
     mysql -u root -p
     CREATE DATABASE your_database_name;
     ```

6. **Run Migrations and Seeders**:
   Run migrations to create tables and seed dummy data (if applicable):
   ```
   php artisan migrate:fresh --seed
   ```

7. **Compile Assets**:
   If the project uses CSS/JS (e.g., Tailwind or Bootstrap):
   ```
   npm run dev  # For development
   # or
   npm run build  # For production
   ```

8. **Start the Development Server**:
   ```
   php artisan serve
   ```
   Open in browser: `http://127.0.0.1:8000`

9. **Test Routes**:
   - For CRUD: Navigate to routes like `/stu` (list), `/stu/create` (add form), etc.
   - For Authentication: `/register`, `/login`, `/dashboard`.
   - Repeat setup for each folder as they are independent projects.

## Folder 1: project-db (Query Builder CRUD + Basic Concepts)
This folder demonstrates CRUD (Create, Read, Update, Delete) operations using Laravel's Query Builder. It also introduces fundamental Laravel concepts like routes, Blade templates, models, and controllers.

### Step-by-Step Explanation
1. **Routes (routes/web.php)**:
   - Routes Laravel ke URL handlers hote hain. Yeh request ko controller method se link karte hain.
   - Example: `Route::resource('/stu', StudentController::class);` automatic CRUD routes banata hai:
     - GET `/stu` -> index (list)
     - GET `/stu/create` -> create (add form)
     - POST `/stu` -> store (save new record)
     - GET `/stu/{id}` -> show (view single)
     - GET `/stu/{id}/edit` -> edit (update form)
     - PUT `/stu/{id}` -> update (save changes)
     - DELETE `/stu/{id}` -> destroy (delete)
   - Concept: Routes `web.php` mein define hote hain for web requests, aur `api.php` mein for APIs.

2. **Blade Files (resources/views)**:
   - Blade Laravel ka templating engine hai, jo PHP code ko HTML mein embed karta hai.
   - Example: `welcome.blade.php` mein `@foreach ($students as $data)` data loop kar ke table show karta hai.
   - Directives: `@if`, `@foreach`, `@extends('layout')` for inheritance, `@section('content')` for sections.
   - Concept: Blade files `.blade.php` extension ke saath hoti hain, aur dynamic data render karti hain (e.g., {{ $variable }}).

3. **Models (app/Models/Student.php)**:
   - Models database tables ko represent karte hain.
   - Example: `class Student extends Model` `student` table se map karta hai. `$table = 'student';` custom table naam set karta hai.
   - Concept: Models Eloquent ORM use karte hain for database operations (e.g., Student::all(), Student::create($data)).

4. **Controllers (app/Http/Controllers/StudentController.php)**:
   - Controllers logic handle karte hain (e.g., data fetch, validation).
   - Example: `index()` method `Student::all()` se data lata hai aur view ko pass karta hai: `return view('welcome', compact('students'));`.
   - Concept: Resource controllers CRUD methods provide karte hain (index, create, store, show, edit, update, destroy).

5. **CRUD with Query Builder**:
   - Query Builder `DB::table('student')` use kar ke raw SQL-like queries banata hai without models.
   - Example in controller:
     - Read: `DB::table('student')->get();`
     - Create: `DB::table('student')->insert($data);`
     - Update: `DB::table('student')->where('id', $id)->update($data);`
     - Delete: `DB::table('student')->where('id', $id)->delete();`

6. **Setup for this Folder**:
   - Follow general setup above.
   - Seed data: `php artisan db:seed` (if seeder defined).
   - Test: Visit `/stu` for student list.

## Folder 2: eloquent-orm (Eloquent ORM CRUD)
This folder shows CRUD using Eloquent ORM, which is more object-oriented than Query Builder.

### Step-by-Step Explanation
1. **Eloquent ORM Basics**:
   - Eloquent models use kar ke database interact karta hai.
   - Example: `Student::all()` sab records lata hai.
   - Create: `Student::create($data);`
   - Update: `$student->update($data);`
   - Delete: `$student->delete();`

2. **Setup**:
   - Same as general setup.
   - Test routes like `/stu` for list, `/stu/{id}` for single view.

## Folder 3: middleware (Middlewares Example)
This folder demonstrates how middlewares work in Laravel.

### Step-by-Step Explanation
1. **Middlewares Basics**:
   - Middlewares request ko filter karte hain pehle controller tak jane se (e.g., auth check, logging).
   - Example: `ValidUser` middleware `Auth::check()` se user authenticated hai ya nahi check karta hai.

2. **Custom Middleware Creation**:
   - Command: `php artisan make:middleware ValidUser`
   - `handle` method mein logic likho (e.g., if authenticated, `$next($request)` call karo, warna redirect).
   - Register in `Kernel.php`: `$middlewareAliases = ['valid.user' => ValidUser::class];`

3. **Usage**:
   - Route mein: `->middleware('valid.user')`
   - Example: Dashboard route par lagao taake sirf logged-in user access kare.

4. **Setup**:
   - Same as general setup.
   - Test: Login kar ke `/dashboard` access karo – middleware check karega.

## Folder 4: authentication (Authentication System)
This folder covers user authentication (register, login, logout).

### Step-by-Step Explanation
1. **Authentication Basics**:
   - `User` model authentication ke liye use hota hai (extends Authenticatable).
   - Routes: `/register`, `/login`, `/logout`.
   - Controller: `AuthController` mein `register` password hash karta hai (`Hash::make()`), `login` `Auth::attempt()` use kar ke verify karta hai.

2. **Setup**:
   - `.env` mein DB credentials set karo.
   - Migrations run karo for `auths` table.
   - Test: Register karo, login karo, dashboard dekho.

## Troubleshooting
- **Common Errors**:
  - Table not found: `php artisan migrate`
  - Class not found: Composer dump-autoload (`composer dump-autoload`)
  - Middleware not found: Kernel.php check karo
- **Debug**: `.env` mein `APP_DEBUG=true` rakho for detailed errors.

If you have questions or issues, open an issue on GitHub. Contributions welcome!
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> d64f76d (Learn About MiddleWare and Queue In Laravel)
