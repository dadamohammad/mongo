<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Shop;
use App\Models\User;
use App\Notifications\SmsIr;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;



class RegisterController extends Controller
{

    public function register(Request $request) {
        \Illuminate\Support\Facades\Validator::validate($request->all(), [
            'phone' => 'required|unique:users,phone|size:11',
        ]);


        $phone = $request->phone;

        $randCode = rand('1000', '9999');


        $code = Code::create([
            'mobile' => $phone,
            'rand_code' => $randCode
        ]);

        $code->save();

//        event(new Code($phone, $code));

//        $user = auth()->user();
//        $code = Code::find(1);
        Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '09122710574',
            'password' => 'b4cac3e4-a242-4606-ab12-e7e9de96851a',
            'from'     => '50004001710574',
            'to'       => $phone,
            'text'     => $randCode
        ]);

        return "کد به $phone ارسال شد";
    }

    public function verify(Request $request) {
        \Illuminate\Support\Facades\Validator::validate($request->all(), [
            'phone' => 'required|unique: users,phone|size: 11',
            'code' => 'required|size: 4',
        ]);

        $phone = $request->phone;
        $code = $request->code;

        $code = Code::where([
            ['mobile', $phone],
            ['rand_code', intval($code)]
        ])->first();

        if ($code) {
            $currentTime = \Carbon\Carbon::now(); // 2023-01-01
            $codeSendTime = $code->created_at;
            $diff = $currentTime->diff($codeSendTime)->i;

            if ($diff < 2) {
                return 'کد با موفقیت ثبت شد';
            }
        }
        return "not create";
    }
}
