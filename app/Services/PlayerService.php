<?php

namespace App\Services;


use App\Coin;
use App\Configuration;
use App\Role;
use App\User;
use App\Player;
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $admin ? Hash::make(config('app.default_pass')) : Hash::make($data['password']),            
        ]);

        $player = Player::create([
            'education' => $data['education'],
            'grade_id' => $data['grade'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city_id' => $data['city']
        ]);

        $player->school =  $data['institution'] ?? null;
        $player->save();

        // Assign role
        if($admin) {
            $user->assignRole($data["role"]);
        } else {
            $user->assignRole(Role::PLAYER);
        }

        // Add default coins
        $this->addCoinsToStudent($coins, $user->id);

        // Return created object
        return $player;
    }

    /**
     * Add coins records for the student
     *
     * @param int $coins
     * @param string $player_id
     */
    private function addCoinsToStudent(int $coins, string $user)
    {
        factory(Coin::class, $coins)->create(['user_id' => $user_id]);
    }
}
