<?php

namespace App\Listeners;

use App\Events\UserChangePasswordEvent;
use App\Mail\UserChangePasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserChangePasswordListener implements ShouldQueue
{
    public $connection = 'database';
    public $delay = '10';
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
     * @param  \App\Events\UserChangePasswordEvent  $event
     * @return void
     */
    public function handle(UserChangePasswordEvent $event)
    {
        Mail::to($event->user->email)->send(
            new UserChangePasswordMail($event->url, $event->user)
        );
    }
}
