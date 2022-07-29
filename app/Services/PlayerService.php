<?php

namespace App\Services;


use App\Models\Coin;
use App\Models\CoinType;
use App\Models\Configuration;
use App\Models\User;
use App\Models\Player;
use App\Models\Version;
use Illuminate\Support\Facades\Hash;

class PlayerService
{

    /**
     * Player registration
     *
     * @param array $data
     * @param int $coins
     * @param bool $admin
     * @return User
     */
    public function addPlayer(array $data, int $coins, bool $admin = false): Player
    {
        // Insert record in table users
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $admin ? Hash::make(config('app.default_pass')) : Hash::make($data['password']),
        ]);

        $player = Player::create([
            'education_id' => $data['education'],
            'grade_id' => $data['grade'],
            'country_iso' => $data['country_iso'],
            'state_iso' => $data['state'],
            'city_id' => $data['city']
        ]);

        $player->school =  $data['institution'] ?? null;
        $player->save();
        $player->user()->save($user);
        $user->versions()->attach(Version::currentVersion());

        // Assign role
        if($admin) {
            $user->assignRole($data["role"]);
        } else {
            $user->assignRole(User::PLAYER_ROLE);
        }

        // Add default coins
        $this->addCoinsToPlayer($coins, $player->id, CoinType::getTypeByKey(CoinType::TYPE_REGISTER));

        // Return created object
        return $player;
    }

    /**
     * Add coins records for the student
     *
     * @param int $coins
     * @param string $player_id
     * @param int $coin_type_id
     */
    private function addCoinsToPlayer(int $coins, string $player_id, int $coin_type_id)
    {
        factory(Coin::class, $coins)->create([
            'player_id' => $player_id,
            'coin_type_id' => $coin_type_id
        ]);
    }
}
