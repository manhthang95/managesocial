<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageUserLogs;
use App\Models\ManageUser;
use App\Services\AuthService;
use Auth;

class ManageLoginController extends Controller 
{

    public static function login(Request $request)
    {
        //check login
        if(Auth::check()){
            return redirect('/welcome.html');
        }
        return view('login');
    }
    
    public static function loginAction(Request $request){
        //check login
        if(Auth::check()){
            return redirect('/welcome.html');
        }
        $loginAdmin = AuthService::loginAdmin($request);
        if($loginAdmin['status']){
            $data['login'] = 'Đăng nhập thành công';
            $data['user_id'] = Auth::User()->id;
            $data['email'] = Auth::User()->email;
            //add log
            $log['user_id'] = Auth::User()->id;
            $log['email'] = Auth::User()->email;
            $log['action'] = "Đăng nhập thành công";
            $log['content'] = json_encode($data);
            $log['created_at'] = date("Y-m-d H:i:s");
            $log['updated_at'] = date("Y-m-d H:i:s");
            $log['ip'] = $request->ip();
            ManageUserLogs::addLog($log);
        }
        return $loginAdmin;
    }
    
    /*
    * function logout
    */
    public static function logout()
    {
        Auth::logout();
        return redirect('/login.html');
    }
    
    /*
     * sửa thông tin cá nhân
     */
    public static function myProfile(Request $request){
        //check login
        if(!Auth::check()){
            return redirect('/login.html');
        }
        //menu - check menu
        $data['Menu'] = "";
        $data['Sub'] = "";
        $data['user_id'] = Auth::User()->id;
        $data['email'] = Auth::User()->email;
        if(!$data['user_id'] || !$data['email']){
            return redirect('/login.html');
        }
        return view('my_profile')->with('data', $data);
    }
    
    /*
     * xử lý
     */
    public static function editMyProfileAction(Request $request){
        //check login
        if(!Auth::check()){
            return redirect('/login.html');
        }
        $id = $request->input('id', '');
        $password = $request->input('password', '');
        $user_id = Auth::User()->id;
        if($password){
            if($user_id != $id){
                $data['status'] = false;
                $data['msg'] = 'Dữ liệu đầu vào không hợp lệ !';
                return response()->json($data);
            }
            $parram['password'] = bcrypt($password);
            $update = ManageUser::editUserInfo($user_id, $parram);
            if($update){
                //add log
                $log['user_id'] = Auth::User()->id;
                $log['email'] = Auth::User()->email;
                $log['action'] = "Cập nhật tài khoản có ID = ".$user_id." thành công";
                $log['content'] = json_encode(["user_id"=>$user_id]);
                $log['created_at'] = date("Y-m-d H:i:s");
                $log['updated_at'] = date("Y-m-d H:i:s");
                $log['ip'] = $request->ip();
                ManageUserLogs::addLog($log);
                $data['status'] = true;
                $data['msg'] = "Thay đổi mật khẩu thành công !!!";
                return response()->json($data);
            }else{
                $data['status'] = false;
                $data['msg'] = "Lỗi khi thay đổi mật khẩu !";
                return response()->json($data);
            }
        }else{
            $data['status'] = false;
            $data['msg'] = 'Không có gì thay đổi cả :D';
            return response()->json($data);
        }
    }

}
