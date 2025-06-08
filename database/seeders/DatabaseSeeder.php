<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PatientSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,

            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            PatientSeeder::class,
            DiagnosesSeeder::class

        ]);
    }
}
