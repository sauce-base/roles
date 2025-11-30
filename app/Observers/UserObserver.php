<?php

namespace Modules\Roles\Observers;

use App\Models\User;
use Modules\Roles\Enums\Role;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Assign the default User role to newly created users
        $user->assignRole(Role::USER);
    }
}
