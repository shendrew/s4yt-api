<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                "key" => "initial_coins",
                "value" => "10"
            ]
        ];

        DB::table('configurations')->insert($configs);
    }
}
