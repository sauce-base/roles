# Roles Module

A comprehensive roles and permissions module built on top of [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission). This module provides a robust system for managing user roles, permissions, and access control in your Laravel application.

## Features

- Role-based access control (RBAC)
- Permission management
- Guard support for multiple authentication systems
- Middleware for route protection
- Blade directives for view-level permissions
- Team/organization support
- Database-driven permissions with caching

## Installation

To install the Roles module, run the following commands:

```bash
composer require saucebase/roles --dev
```

After installing the package, regenerate the Composer autoload files:

```bash
composer dump-autoload
```

Then, enable the module using Artisan:

```bash
php artisan module:enable Roles
```

## Configuration

Make sure to use the `HasRoles` trait in your `User` model:

```php
use HasRoles;
```

### Middleware Registration

For route protection, you'll need to register the middleware in your `bootstrap/app.php`. The Roles module provides three middleware classes from Spatie's Laravel Permission package:

```php
// In bootstrap/app.php
$middleware->alias([
    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
]);
```

Example implementation in middleware registration:

```php
 ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
            //...
        ]);

        /* Register Spatie Permission Middleware */
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
```

For more middleware options and combinations, refer to the [Spatie Laravel Permission documentation](https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware).
