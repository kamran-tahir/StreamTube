<?php
namespace App\Listeners;

use App\User;
use Auth;

class UserEventListener
{
    /**
     * Handle user login events.
     * 
     * @param User $user
     * @param bool $remember
     */
    public function onUserLogin($event)
    {
       if(\Auth::check()){
            $user = Auth::user();
            $user->login_count++;
            $user->save();
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
       
        // $events->listen(
        //     'auth.login',
        //     'App\Listeners\UserEventListener@onUserLogin'
        // );
    }
}