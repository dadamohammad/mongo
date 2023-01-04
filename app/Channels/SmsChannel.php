<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use League\Uri\Http;

class SmsChannel{

    public function send($notifiable, Notification $notification)
    {
        return Http::post('http://api.payamak-panel.com/post/Send.asmx');
    }

}
