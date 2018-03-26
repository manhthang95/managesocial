<?php

namespace App\Services;

use Config;
use Auth;

class AuthService 
{
    /*
     * function check login
     */

    public static function checkLogin($request) 
    {
        // get user info in session
        $user_id = $request->session()->get('user_id', 0);
        $email = $request->session()->get('email', '');
        $secret_key = $request->session()->get('secret_key', '');

        if (!$user_id || !$email) {
            return false;
        }

        // get secret key
        $SecretKey = Config::get('constants.secret_key.signature_key');

        // check session secret key 
        $check_key = md5($user_id . $email . 'logined' . $SecretKey);
        if ($secret_key != $check_key) {
            return false;
        }

        return true;
    }

    /*
     * function login user
     */

    public static function loginAdmin($request) 
    {
        $result['status'] = false;
        $result['msg'] = "";
        $result['url'] = "";
        
        $email = $request->input('user_email', '');
        $password = $request->input('user_password', '');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $result['status'] = true;
            $result['msg'] = "Login thành công !!!";
            $result['url'] = "welcome.html";
            return $result;
        }else{
            $result['status'] = false;
            $result['msg'] = "Tài khoản bạn nhập vào không đúng !";
            $result['url'] = "";
        }
    }

}
