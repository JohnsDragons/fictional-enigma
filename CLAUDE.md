# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 web application with modern frontend tooling (Vite + TailwindCSS). The project follows standard Laravel conventions with MVC architecture, Eloquent ORM, and Artisan CLI.

## Development Commands

### PHP/Laravel Commands
- `php artisan serve` - Start the Laravel development server
- `php artisan test` - Run PHPUnit tests
- `php artisan migrate` - Run database migrations
- `php artisan tinker` - Interactive PHP REPL with Laravel context
- `php artisan queue:listen --tries=1` - Start queue worker
- `php artisan pail --timeout=0` - Real-time log viewer
- `php artisan config:clear` - Clear configuration cache

### Frontend Commands
- `npm run dev` - Start Vite development server with hot reload
- `npm run build` - Build assets for production

### Composer Commands
- `composer dev` - Start full development environment (Laravel server + queue + logs + Vite)
- `composer test` - Clear config and run tests

### Testing
- Run all tests: `php artisan test`
- Run specific test suite: `php artisan test --testsuite=Feature` or `--testsuite=Unit`
- PHPUnit config is in `phpunit.xml` with SQLite in-memory database for testing

## Architecture

### Backend Structure
- **Models**: `app/Models/` - Eloquent models (e.g., User.php)
- **Controllers**: `app/Http/Controllers/` - HTTP request handlers
- **Database**: SQLite database at `database/database.sqlite`
- **Migrations**: `database/migrations/` - Database schema versioning
- **Factories**: `database/factories/` - Model factories for testing/seeding
- **Routes**: `routes/web.php` for web routes, `routes/console.php` for Artisan commands

### Frontend Structure
- **Assets**: `resources/css/app.css` and `resources/js/app.js` - Main frontend entry points
- **Views**: `resources/views/` - Blade templates
- **Build Tool**: Vite with Laravel plugin and TailwindCSS integration
- **Config**: `vite.config.js` - Frontend build configuration

### Key Files
- `artisan` - Laravel CLI tool
- `composer.json` - PHP dependencies and scripts
- `package.json` - Node.js dependencies and build scripts
- `phpunit.xml` - Testing configuration