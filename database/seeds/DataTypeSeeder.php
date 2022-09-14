<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_types = [
            [ 'name' => 'integer' ],
            [ 'name' => 'datetime' ],
        ];
        DB::table('data_types')->insert($data_types);
    }
}
