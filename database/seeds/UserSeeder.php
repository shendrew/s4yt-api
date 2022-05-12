<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = \App\User::create([
            'name' => config('app.super_admin.name'),
            'email' => config('app.super_admin.email'),
            'password' => \Illuminate\Support\Facades\Hash::make(config('app.super_admin.password'))
        ]);

        $super_admin->assignRole(\App\Role::SUPER_ADMIN);


        $admin = \App\User::create([
            'name' => config('app.admin.name'),
            'email' => config('app.admin.email'),
            'password' => \Illuminate\Support\Facades\Hash::make(config('app.admin.password'))
        ]);

        $admin->assignRole(\App\Role::ADMIN);

        if (env('APP_ENV') != 'production')
        {
            factory('App\User', 10)->create();
        }
    }
}
