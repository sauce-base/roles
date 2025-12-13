<?php

namespace Modules\Roles\Filament;

use App\Filament\ModulePlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class RolesPlugin implements Plugin
{
    use ModulePlugin;

    public function getModuleName(): string
    {
        return 'Roles';
    }

    public function getId(): string
    {
        return 'roles';
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
