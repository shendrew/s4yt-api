<?php

namespace App\Services;


use App\Coin;
use App\Configuration;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class PlayerService
{

    /**
     * Player registration
     *
     * @param array $data
     * @param int $coins
     * @return User
     */
    public function addPlayer(array $data, int $coins, bool $admin = false): User
    {
        // Insert record in table users
        $player = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $admin ? Hash::make(config('app.default_pass')) : Hash::make($data['password']),
            'country' => $data['country'],
            'state' => $data['state'],
            'city_id' => $data['city']
        ]);

        $player->education_id = $data['education'];
        $player->school =  $data['institution'] ?? null;
        $player->grade_id = $data['grade'];
        $player->save();

        // Assign role
        if($admin) {
            $player->assignRole($data["role"]);
        } else {
            $player->assignRole(Role::PLAYER);
        }

        // Add default coins
        $this->addCoinsToStudent($coins, $player->id);

        // Return created object
        return $player;
    }

    /**
     * Add coins records for the student
     *
     * @param int $coins
     * @param string $player_id
     */
    private function addCoinsToStudent(int $coins, string $player_id)
    {
        factory(Coin::class, $coins)->create(['user_id' => $player_id]);
    }
}
