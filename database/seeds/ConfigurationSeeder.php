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
                "value" => "10",
                "data_type" => "int"
            ],
            [
                'key' => 'game_start',
                'value' => '',
                'description' => 'Date format: mm-dd-YYYY HH:ii (' . config('app.timezone') . '). Set the time of the start at the game. At this point the student will be able to interact with the game.'
            ],
            [
                'key' => 'game_end',
                'value' => '',
                'description' => 'Date format: mm-dd-YYYY HH:ii (' . config('app.timezone') . '). Set the time of the start at the game. At this point the student will no longer be able to interact with the game.'
            ],
            [
                'key' => 'winners_announced',
                'value' => '',
                'description' => 'Date format: mm-dd-YYYY HH:ii (' . config('app.timezone') . '). Set the time of the start at the game. At this point the award and raffle items are chosen and the related mailing is sent.'
            ],
            [
                'key' => 'login_disabled',
                'value' => '',
                'description' => 'Date format: mm-dd-YYYY HH:ii (' . config('app.timezone') . '). Set the time of the start at the game. At this point the login will be disables for students, businesses and sponsors.'
            ]
        ];

        DB::table('configurations')->insert($configs);
    }
}
