<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            ['name' => '9th grade'],
            ['name' => '10th grade'],
            ['name' => '11th grade'],
            ['name' => '12th grade']
        ];

        DB::table('grades')->insert($grades);
    }
}
