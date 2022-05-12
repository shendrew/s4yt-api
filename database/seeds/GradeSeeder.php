<?php

use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert(['name' => '9']);
        DB::table('grades')->insert(['name' => '10']);
        DB::table('grades')->insert(['name' => '11']);
        DB::table('grades')->insert(['name' => '12']);
    }
}
