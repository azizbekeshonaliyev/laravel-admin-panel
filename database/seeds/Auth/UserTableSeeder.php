<?php

use App\Models\Auth\User;
use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        //Add the master administrator, user id of 1
        $users = [
            [
                'first_name' => 'Azizbek',
                'last_name' => 'Eshonaliyev',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'uuid' => Str::uuid(),
            ],
            [
                'first_name' => 'Executive',
                'last_name' => 'Executive',
                'username' => 'execution',
                'email' => 'executive@executive.com',
                'password' => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'uuid' => Str::uuid(),
            ],
            [
                'first_name' => 'User',
                'last_name' => 'Test',
                'username' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'uuid' => Str::uuid(),
            ],
        ];

        DB::table('users')->insert($users);

        $this->enableForeignKeys();
    }
}
