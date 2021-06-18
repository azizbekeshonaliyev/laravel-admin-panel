<?php

use App\Models\Auth\Role;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('permission_role');

        // Assign permission to executive role
        $executivePermission = [1, 3, 4, 5, 6, 7, 8, 16, 20];
        Role::find(2)->permissions()->sync($executivePermission);

        // Assign view frontend to user role
        Role::find(3)->permissions()->sync([2]);

        $this->enableForeignKeys();
    }
}
