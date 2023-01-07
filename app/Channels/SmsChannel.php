<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use League\Uri\Http;

class SmsChannel{

    public function send($notifiable, Notification $notification)
    {
        return Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '09122710574',
            'password' => 'b4cac3e4-a242-4606-ab12-e7e9de96851a',
            'from'     => '50004001710574',
            'to'       => '09353770652',
            'text'     => 'dsdsdsd'
            ]);
    }

}
