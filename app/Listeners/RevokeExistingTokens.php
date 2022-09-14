<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/*
|--------------------------------------------------------------------------
| RevokeExistingTokens
|--------------------------------------------------------------------------
|
| This listener is called upon newly created passport tokens for players.
| The objective of this process is to have only one active token at a time.
| The call is defined in EventServiceProvider.
|
*/

class RevokeExistingTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::find($event->userId);

        $user->tokens()->limit(PHP_INT_MAX)->offset(1)->get()->map(function ($token) {
            $token->revoke();
        });
    }
}
