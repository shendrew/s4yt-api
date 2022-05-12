<?php

use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert(['name' => 'High school']);
        DB::table('educations')->insert(['name' => 'Home school']);
        DB::table('educations')->insert(['name' => 'Currently not in school']);
    }
}
