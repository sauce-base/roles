<?php

namespace Modules\Roles\Traits;

use Modules\Roles\Enums\Role;
use Spatie\Permission\Traits\HasRoles as SpatieHasRoles;

trait HasRoles
{
    use SpatieHasRoles;

    /**
     * Check if user is an administrator
     *
     * @return bool True if the user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ADMIN);
    }

    /**
     * Check if user is a regular user
     *
     * @return bool True if the user has user role
     */
    public function isUser(): bool
    {
        return $this->hasRole(Role::USER);
    }

    /**
     * Get the user's role as an enum
     *
     * @return Role The user's role
     */
    public function getRole(): Role
    {
        return Role::fromString($this->getRoleNames()->first());
    }

    /**
     * Get user role label for display purposes
     *
     * @return string The human-readable role label
     */
    public function getRoleLabelAttribute(): string
    {
        $role = Role::fromString($this->getRoleNames()->first());

        return $role->label();
    }

    /**
     * Get user role description
     *
     * @return string The role description
     */
    public function getRoleDescriptionAttribute(): string
    {
        $role = Role::fromString($this->getRoleNames()->first());

        return $role->description();
    }
}
