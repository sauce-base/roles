<?php

namespace Modules\Roles\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        Route::middleware('web')
            ->group(module_path('roles', '/routes/web.php'));
        Route::middleware('api')
            ->group(module_path('roles', '/routes/api.php'));
    }
}
