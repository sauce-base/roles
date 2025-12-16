# Roles Module

A comprehensive roles and permissions module for [Sauce Base](https://github.com/sauce-base/core) built on top of [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission).

## Installation

Install via Composer:

```bash
composer require saucebase/roles
composer dump-autoload
docker compose exec workspace php artisan module:enable Roles
docker compose exec workspace php artisan module:migrate Roles --seed
npm run build
```

## Features

This module extends [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) with Sauce Base-specific enhancements:

- **Predefined Role System** — Admin and User roles with enum-based type safety
- **Automatic Role Assignment** — New users are automatically assigned the User role via UserObserver
- **Enhanced User Model** — Extended HasRoles trait with convenience methods:
    - `isAdmin()` and `isUser()` helper methods
    - `getRole()` and `getRoleLabel()` attribute accessors
    - Type-safe role checking with Role enum
- **Database Seeding** — Automatic role creation via `module:seed Roles` command
- **Filament Integration** — Modular plugin system ready for admin panel integration
- **Module Structure** — Organized codebase following Sauce Base module conventions

For complete role and permission management features (middleware, blade directives, caching, etc.), see the [Spatie Laravel Permission documentation](https://spatie.be/docs/laravel-permission).

## Configuration

### User Model Setup

Add the `HasRoles` trait to your User model:

```php
use Modules\Roles\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // ... rest of your model
}
```

### Middleware Registration

Register the middleware in your `bootstrap/app.php` for route protection:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        HandleInertiaRequests::class,
        AddLinkHeadersForPreloadedAssets::class,
        // ...
    ]);

    // Register Spatie Permission Middleware
    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ]);
```

## Usage

### Available Roles

The module comes with predefined roles:

- **Admin** — Full access to Filament panel and dashboard
- **User** — Limited access to dashboard features

### Assigning Roles

```php
use Modules\Roles\Enums\Role;

// Assign role to user
$user->assignRole(Role::ADMIN);
$user->assignRole(Role::USER);

// Check if user has role
if ($user->hasRole(Role::ADMIN)) {
    // User is admin
}

// Get user roles
$roles = $user->roles;
```

### Route Protection

Protect routes using middleware:

```php
// Require specific role
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', AdminController::class);
});

// Require any of multiple roles
Route::middleware(['role:admin|user'])->group(function () {
    Route::get('/dashboard', DashboardController::class);
});
```

### Filament Admin Panel Protection

The Filament admin panel is protected with the `role:admin` middleware. This is configured in `app/Providers/Filament/AdminPanelProvider.php`:

```php
->authMiddleware([
    Authenticate::class,
    'role:admin',
])
```

**Creating Admin Users:**

```bash
# Via Artisan Tinker
docker compose exec workspace php artisan tinker

# Create an admin user
$user = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
]);

$user->assignRole('admin');
```

**Or via Seeder/Factory:**

```php
$admin = User::factory()->create();
$admin->assignRole(Role::ADMIN);
```

Only users with the `admin` role can access `/admin` panel. Regular users will get a 403 Forbidden response.

For more advanced usage, refer to the [Spatie Laravel Permission documentation](https://spatie.be/docs/laravel-permission).

## Testing

The module includes unit tests to verify the automatic role assignment functionality:

```bash
# Run all Roles module tests
vendor/bin/phpunit modules/Roles/tests/

# Run specific UserObserver tests
vendor/bin/phpunit modules/Roles/tests/Unit/UserObserverTest.php
```

Tests verify:

- New users are automatically assigned the User role
- Role assignment doesn't create duplicates
- Observer doesn't interfere with manually assigned roles
