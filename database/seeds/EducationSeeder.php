<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            ['name' => 'High school'],
            ['name' => 'Home school'],
            ['name' => 'Currently not in school']
        ];

        DB::table('educations')->insert($educations);
    }
}
