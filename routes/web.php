<?php

use Modules\Roles\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RolesController::class);
