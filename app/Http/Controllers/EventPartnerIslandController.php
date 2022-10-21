<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Answer;
use Illuminate\Http\Request\AnswerRequest;
use Illuminate\Http\JsonResponse;

class EventPartnerIslandController extends Controller
{
    public function addVisit($event_partner_id, $player_id) : JsonResponse
    {
        if (!Visit::where('event_partner_id', $event_partner_id)->where('player_id', $player_id)->exists())
        {
            Visit::create([
                'event_partner_id' => $event_partner_id,
                'player_id' => $player_id
            ]);

            return $this->sendResponse(
                [
                    'event_partner_id' => $event_partner_id,
                    'player_id' => 'player_id'
                ],
                'Success, new visit created.'
            );
        }

        return $this->sendResponse(
            [
                'event_partner_id' => $event_partner_id,
                'player_id' => 'player_id'
            ],
            'Visit already exists.'
        );
    }

    public function saveAnswer(AnswerRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        if (!Answer::where('question_id', $validated->question_id)->where('player_id', $validated->player_id)->exists())
        {
            Answer::create([
                'question_id' => $validated->question_id,
                'player_id' => $validated->player_id,
                'response' => $validated->response,
                'submitted' => false
            ]);

            return $this->sendResponse(
                [
                    'question_id' => $validated->question_id,
                    'player_id' => $validated->player_id,
                    'response' => $validated->response,
                    'submitted' => false
                ],
                'Success, new answer saved.'
            );
        }

        $answer = Answer::where('question_id', $validated->question_id)->where('player_id', $validated->player_id);
        $answer->response = $validated->response;
        $answer->save();

        return $this->sendResponse(
            [
                'question_id' => $validated->question_id,
                'player_id' => $validated->player_id,
                'response' => $validated->response,
                'submitted' => false
            ],
            'Success, answer saved.'
        );
    }

    public function submitAnswer(AnswerRequest $request) : JsonResponse
    {
        $validated = $request->validated();

        $answer = Answer::where('question_id', $validated->question_id)->where('player_id', $validated->player_id);
        $answer->response = $validated->response;
        $answer->submitted = true;
        $answer->save();

        return $this->sendResponse(
            [
                'question_id' => $validated->question_id,
                'player_id' => $validated->player_id,
                'response' => $validated->response,
                'submitted' => false
            ],
            'Success, answer submitted.'
        );
    }

    public function getAnswer($id)
    {
        $answer = Answer::find($id);
        return $answer;
    }
}
