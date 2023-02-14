<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super_admin@arkusnexus.com',
            'password' => Hash::make('@superadmin1')
        ]);

        Role::create(['name' => 'super-admin', 'guard_name' => 'api']);
        Role::create(['name' => 'admin', 'guard_name' => 'api']);
        Role::create(['name' => 'normal-user', 'guard_name' => 'api']);

        $user->assignRole('super-admin');
    }
}
