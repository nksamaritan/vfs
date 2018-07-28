<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Illuminate\Support\Facades\Config as config;
class SendMailFired
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
     * @param  SendMail $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $user['user_data'] = $event->userDatas;

        Mail::send($user['user_data']['viewTemplate'], $user, function ($message) use ($user) {

            $message->from(config::get('constant.FROM_EMAIL'), config::get('constant.FROM_NAME'));
            $message->to($user['user_data']['email']);
            $message->subject($user['user_data']['subjectLine']);

        });
    }
}
