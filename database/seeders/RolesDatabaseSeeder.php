<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Roles\Enums\Role as RoleEnum;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles using the Role enum
        foreach (RoleEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value], [
                'name' => $role->value,
                'guard_name' => 'web',
            ]);
        }
    }
}
