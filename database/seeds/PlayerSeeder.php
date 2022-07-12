<?php

use App\Models\Version;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') != 'production')
        {
            factory(App\Models\Player::class, 8)->create()->each(function ($player){
                $player->user()->save(factory(App\Models\User::class)->make());
                $player->user->assignRole(\App\Models\User::PLAYER_ROLE);
                $player->user->versions()->attach(Version::currentVersion());
            });
            factory(App\Models\Player::class, 2)->create()->each(function ($player){
                $player->user()->save(factory(App\Models\User::class)->make());
                $player->user->assignRole(\App\Models\User::BU_PLAYER_ROLE);
                $player->user->versions()->attach(Version::currentVersion());
            });
        }
    }
}
