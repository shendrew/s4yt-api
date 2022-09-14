<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coin_types = [
            ['event' => 'register'],
        ];

        DB::table('coin_types')->insert($coin_types);
    }
}
