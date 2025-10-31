<?php

namespace Modules\Roles\Http\Controllers;

use Inertia\Inertia;

class RolesController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Roles::Index', [
            'message' => 'Welcome to Roles Module',
            'module' => 'roles',
        ]);
    }
}
