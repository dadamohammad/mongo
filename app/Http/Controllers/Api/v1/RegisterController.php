<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Notifications\SmsIr;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;


class RegisterController extends Controller
{

    public function register(Request $request, User $user) {
        \Illuminate\Support\Facades\Validator::validate($request->all(), [
            'phone' => 'required|unique:users,phone|size:11',
        ]);


        $phone = $request->phone;

        $code = rand('1000', '9999');


        $codes= Code::create([
            'user' => $phone,
            'code' => $code
        ]);

        $codes->save();

//        event(new Code($phone, $code));

//        $user = auth()->user();
//        $code = Code::find(1);
        Notification::send($user ,new SmsIr($code));

        return "کد به $phone ارسال شد";
    }

    public function verify(Request $request) {
        \Illuminate\Support\Facades\Validator::validate($request->all(), [
            'phone' => 'required|unique: users,phone|size: 11',
            'code' => 'required|size: 4',
        ]);

        $code = $request->code;
        $phone = $request->phone;

        $code = Code::where([
            ['code', $code],
            ['phone', $phone]
        ])->first();

        $currentTime = \Carbon\Carbon::now(); // 2023-01-01
        $codeSendTime = $code->created_at;
        $diff = $currentTime->diff($codeSendTime)->i;

        if ($diff < 2) {
            User::create([
                'phone' => $phone,
            ]);
            return "create";
        }
        return "not create";
    }
}
