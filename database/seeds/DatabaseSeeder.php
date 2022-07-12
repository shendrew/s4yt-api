<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            VersionSeeder::class,
            DataTypeSeeder::class,
            ConfigurationSeeder::class,
            EducationSeeder::class,
            GradeSeeder::class,
            PlayerSeeder::class,
            CoinTypeSeeder::class
        ]);
    }
}
