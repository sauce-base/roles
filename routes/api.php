<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\Http\Controllers\RolesController;

Route::middleware(['auth:sanctum'])->prefix('api/v1/roles')->group(function () {
    Route::apiResource('roles', RolesController::class);
});
