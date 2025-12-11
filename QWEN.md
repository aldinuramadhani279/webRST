# WebRST Laravel Project - QWEN Context

## Project Overview

WebRST is a Laravel PHP web application that leverages the Laravel framework v10.x with Filament admin panel v3.2. This is a modern web application skeleton built on the Laravel framework, designed for creating robust web applications with an elegant and expressive syntax.

### Key Technologies & Features:
- **Framework**: Laravel 10.x
- **PHP Version**: ^8.1
- **Admin Panel**: Filament 3.2 (provides an elegant admin panel with pre-built CRUD functionality)
- **Frontend Build Tool**: Vite 5 with Laravel Vite Plugin
- **HTTP Client**: Guzzle HTTP client
- **API Authentication**: Laravel Sanctum
- **Testing Framework**: PHPUnit 10.x
- **Code Quality**: Laravel Pint for code formatting

### Project Architecture
- **MVC Structure**: Follows Model-View-Controller pattern with additional service layers
- **Filament Integration**: Admin panel resources and configurations
- **RESTful Routing**: Support for API and web routes
- **Dependency Injection**: Laravel's built-in container
- **Database Abstraction**: Eloquent ORM with schema migrations

## Directory Structure

```
WebRST/
├── app/                    # Main application code
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Exception handlers
│   ├── Filament/          # Filament admin panel configuration
│   │   └── Resources/     # Filament resources
│   ├── Http/              # Controllers, middleware
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── bootstrap/             # Framework bootstrapping
├── config/                # Configuration files
├── database/              # Migrations, seeds, factories
├── public/                # Public assets and index.php
├── resources/             # Views, CSS, JS assets
├── routes/                # Route definitions (web, api, console)
├── storage/               # Compiled templates, file uploads
├── tests/                 # Unit and feature tests
├── vendor/                # Composer dependencies
├── artisan                # Laravel command-line interface
├── composer.json          # PHP dependencies
├── package.json           # Frontend dependencies
└── vite.config.js         # Frontend build configuration
```

## Building and Running the Application

### Prerequisites
- PHP 8.1+
- Composer
- Node.js and npm/yarn
- Database (MySQL/MariaDB recommended)

### Setup Instructions

1. **Install PHP Dependencies**:
```bash
composer install
```

2. **Install Frontend Dependencies**:
```bash
npm install
# or
yarn install
```

3. **Environment Configuration**:
```bash
cp .env.example .env  # On Windows: copy .env.example .env
php artisan key:generate
```

4. **Database Setup**:
```bash
# Configure database credentials in .env
# Then run migrations
php artisan migrate
```

5. **Filament Setup**:
```bash
# The application runs filament:upgrade during composer install
# If needed, run manually
php artisan filament:install --panels
```

6. **Running Development Server**:
```bash
# Terminal 1: Start PHP development server
php artisan serve

# Terminal 2: Start Vite dev server (for hot reloading)
npm run dev
```

7. **Building for Production**:
```bash
# Build frontend assets for production
npm run build

# Cache configuration for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Common Commands

- **Artisan Commands**:
  - `php artisan list` - Show available commands
  - `php artisan migrate` - Run database migrations
  - `php artisan db:seed` - Seed the database
  - `php artisan tinker` - Interactive REPL
  - `php artisan optimize` - Optimize for production
  - `php artisan filament:install` - Filament installation

- **Frontend Commands**:
  - `npm run dev` - Start development server with HMR
  - `npm run build` - Build for production

- **Testing**:
  - `php artisan test` - Run tests
  - `phpunit` - Alternative way to run tests

## Development Conventions

### Coding Standards
- Follow PSR-12 coding standards
- Use Laravel's Pint for code formatting (`vendor/bin/pint`)
- Consistent namespace and class naming conventions
- Follow Laravel's naming conventions for routes, controllers, and models

### Testing Practices
- Unit tests for individual components
- Feature tests for application flows
- Use Laravel's testing helpers and factories
- Tests should be organized in `tests/Unit` and `tests/Feature`

### Filament Integration
- Admin resources defined in `app/Filament/Resources/`
- Panels configured in `app/Filament/`
- Follow Filament's documentation for best practices regarding customizations

### Security Practices
- Always validate and sanitize user inputs
- Use Laravel's built-in protection against CSRF, XSS
- Sanctum for API authentication
- Regular dependency updates

## Special Features

### Filament Admin Panel
This application includes Filament 3.2, which provides:
- Elegant admin panel with pre-built CRUD functionality
- Resource management for models
- Customizable dashboard widgets
- Role-based access control
- Built-in form and table components

### API Support
- Laravel Sanctum for API token authentication
- RESTful API endpoints
- JSON response format

### Asset Management
- Vite for modern asset compilation
- Support for CSS preprocessors
- ES6 module support for JavaScript

## Configuration Notes

### Environment Variables
Critical environment variables include:
- `APP_KEY` - Generated with `php artisan key:generate`
- Database credentials (`DB_*`)
- Mail configuration (`MAIL_*`)
- Redis configuration (`REDIS_*`)
- Queue configuration (`QUEUE_*`)

### Filament Specific
- Filament resources are located in `app/Filament/Resources/`
- The `post-autoload-dump` script runs `filament:upgrade` to ensure proper setup

## Troubleshooting

### Common Issues
1. **Cache Problems**: Clear cache with `php artisan cache:clear`
2. **Route Issues**: Refresh route cache with `php artisan route:clear`
3. **Asset Issues**: Rebuild with `npm run build`
4. **Migration Errors**: Run `php artisan migrate:fresh --seed` to reset database

### Development Mode
- Enable debug mode with `APP_DEBUG=true` in `.env`
- Check logs in `storage/logs/laravel.log` for debugging information