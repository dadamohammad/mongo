<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Verify login
     *
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        if ($this->getUser($request->account)->has_password) {
            return 'has password';
        }
        $this->sendSms($request->phone);
        return 'password sent';
    }

    /**
     * Get user account type: username || email || password
     *
     * @param string $account
     * @return string
     */
    protected function getAccountType(string $account): string
    {
        if (Str::contains($account, '@')) {
            return 'email';
        } elseif (preg_match('/[A-Za-z]/', $account)) {
            return 'username' ;
        }
        return 'mobile';
    }

    public function loginVerify(Request $request)
    {
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

    /**
     * Get user
     *
     * @param string $account
     * @return mixed
     */
    protected function getUser(string $account): mixed
    {
        $type = $this->getAccountType($account);
        return User::where($type, $account)->first();
    }

    /**
     * Send sms to specific mobile number
     *
     * @param string $phone
     * @return void
     */
    public function sendSms(string $phone): void
    {
        $randCode = rand('1000', '9999');
        Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
            'username' => '09122710574',
            'password' => 'b4cac3e4-a242-4606-ab12-e7e9de96851a',
            'from'     => '50004001710574',
            'to'       => $phone,
            'text'     => $randCode
        ]);
    }


}
