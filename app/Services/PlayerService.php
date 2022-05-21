<?php

namespace App\Services;

use App\Answer;
use App\Notifications\PlayerRegistrationEmail;
use App\Role;
use App\Ticket;
use App\User;
use App\UserMeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PlayerService
{
    /**
     * Student registration
     *
     * @param array $data
     * @param int $tickets
     * @param bool $welcome_email
     */
    public function addPlayer(array $data, int $tickets,bool $welcome_email = true) {

        // student record
        $player = User::create([
            'role_id' => Role::ROLE_PLAYER,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make(config('app.default_password')),
            'welcome_email' => false
        ]);

        // student metadata
        $this->addPlayerMetaData($data, $player);

        // create tickets
        $this->addTicketsToPlayer($tickets, $player->id);

        // welcome mail
        if($welcome_email)
        {
            $player->notify(new PlayerRegistrationEmail());
            $player->welcome_email = true;
            $player->save();
        }
    }

    public function addTicketsToPlayer( int $tickets, string $player_id)
    {
        factory(Ticket::class, $tickets)->create( ['user_id' => $player_id]);
    }

    private function addPlayerMetaData(array $data, User $player)
    {
        $metadata = [
            'institution'=>'Institution',
            'grade'=>'Grade',
            'dob'=>'Date of Birth',
            'city_state'=> 'City/State',
            'phone'=>'Phone Number',
            'preferred_email'=>'Preferred Email Address'
        ];

        foreach($metadata as $key => $value){
            if(isset($data[$key])){
                UserMeta::create([
                    'user_id' => $player->id,
                    'key' => $key,
                    'value' => $data[$key]
                ]);
            }
        }
    }

    private function deletePlayerMetaData($player_id)
    {
        UserMeta::where('user_id', $player_id)->delete();
    }

    public function updatePLayer(array $data, User $player)
    {
        // update student
        $player->first_name = $data['first_name'];
        $player->last_name = $data['last_name'];
        $player->email = $data['email'];
        $player->save();
        // delete metadata
        $this->deletePlayerMetaData($player->id);
        // student metadata
        $this->addPlayerMetaData($data, $player);
    }

    public function saveAnswer($question_id, $sent_answer, $status)
    {
        $answer = Answer::where([
            ['question_id', $question_id],
            ['user_id', Auth::id()]
        ])->first();

        if(!$answer) {
            $answer = Answer::create([
                'question_id' => $question_id,
                'user_id' => Auth::id(),
                'answer' => $sent_answer
            ]);
        }

        $answer->status = $status;
        $answer->answer = $sent_answer;
        $answer->save();
    }
}