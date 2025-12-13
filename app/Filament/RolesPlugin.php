<?php

namespace Modules\Roles\Filament;

use App\Filament\ModulesFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class RolesPlugin implements Plugin
{
    use ModulesFilamentPlugin;

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
