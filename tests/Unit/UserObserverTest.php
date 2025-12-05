<?php

namespace Modules\Roles\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Roles\Enums\Role;
use Spatie\Permission\Models\Role as SpatieRole;
use Tests\TestCase;

class UserObserverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create the User role in the database
        SpatieRole::create([
            'name' => Role::USER->value,
            'guard_name' => 'web',
        ]);
    }

    public function test_it_assigns_user_role_when_user_is_created(): void
    {
        // Create a new user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assert that the user has the User role
        $this->assertTrue($user->hasRole(Role::USER));
        $this->assertCount(1, $user->roles);

        /**
         * @var SpatieRole $role
         */
        $role = $user->roles->first();

        $this->assertEquals(Role::USER->value, $role->name);
    }

    public function test_it_only_assigns_user_role_once(): void
    {
        // Create a user that already has the User role
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Verify user has the User role
        $this->assertTrue($user->hasRole(Role::USER));
        $this->assertCount(1, $user->roles);

        // Try to assign the role again manually
        $user->assignRole(Role::USER);

        // Should still only have one role (no duplicates)
        $this->assertCount(1, $user->roles);
    }

    public function test_it_does_not_interfere_with_existing_roles(): void
    {
        // Create admin role
        SpatieRole::create([
            'name' => Role::ADMIN->value,
            'guard_name' => 'web',
        ]);

        // Create a user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assign admin role manually
        $user->assignRole(Role::ADMIN);

        // Should have both User (from observer) and Admin (manually assigned) roles
        $this->assertTrue($user->hasRole(Role::USER));
        $this->assertTrue($user->hasRole(Role::ADMIN));
        $this->assertCount(2, $user->roles);
    }
}
