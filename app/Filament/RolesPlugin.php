<?php

namespace Modules\Roles\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class RolesPlugin implements Plugin
{
    use ModuleFilamentPlugin;

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
