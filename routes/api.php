<?php

use Modules\Roles\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('api/v1/roles')->group(function () {
    Route::apiResource('roles', RolesController::class);
});
