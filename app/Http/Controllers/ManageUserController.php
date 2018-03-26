<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\ManageUser;
use App\Models\ManageUserLogs;
use App\Services\AuthPermissionService;
use Auth;

class ManageUserController extends Controller
{

    public function __construct(){
        if(!Auth::check()){
            return redirect('/login.html');
        }
    }

    public static function viewAll(Request $request)
    {
        $data['AllUser'] = ManageUser::getListUser();
        $data['TotalUser'] = ManageUser::getTotalUser();
        //menu - check menu
        $data['Menu'] = "mn-system";
        $data['Sub'] = "sub-list-users";
        //đẩy sang view để append vào phân trang
        $filter['startdate'] = ($request->input("startdate", '') ? $request->input("startdate", '') : "0");
        $filter['enddate'] = ($request->input("enddate", '') ? $request->input("enddate", '') : "0");
        $data['filter'] = $filter;
        return view('manage_user')->with('data', $data);
    }

    /*
     * function show form add User
     */

    public static function addUser(Request $request)
    {
        if(!Auth::User()->is_root == "yes"){
            return redirect('/welcome.html');
        }

        //menu - check menu
        $data['Menu'] = "mn-system";
        $data['Sub'] = "sub-list-users";

        return view('add_user')->with('data', $data);
    }

    /*
     * function process add User info
     */

    public static function addUserAction(Request $request)
    {

        $data['status'] = false;
        $data['msg'] = "Dữ liệu đầu vào không hợp lệ !";

        $parram['name'] = $request->input('name', '');
        $parram['email'] = $request->input('email', '');
        $parram['password'] = bcrypt($request->input('password'));
        $parram['is_root'] = $request->input('is_root', '');
        $parram['created_at'] = date("Y-m-d H:i:s");
        $parram['updated_at'] = date("Y-m-d H:i:s");
        $add = ManageUser::addNewUser($parram);
        if ($add) {
            //add log
            $log['user_id'] = Auth::User()->id;
            $log['email'] = Auth::User()->email;
            $log['action'] = "Thêm mới 1 User có id = " . $add;
            $log['content'] = json_encode($parram);
            $log['created_at'] = date("Y-m-d H:i:s");
            $log['updated_at'] = date("Y-m-d H:i:s");
            $log['ip'] = $request->ip();
            ManageUserLogs::addLog($log);

            $data['status'] = true;
            $data['msg'] = "Thêm mới User thành công !!!";
            return response()->json($data);
        } else {
            $data['msg'] = "Lỗi khi thêm mới User !";
            return response()->json($data);
        }
    }

    /*
     * show page edit User
     */

    public static function editUser(Request $request, $id)
    {
        if (!isset($id) || !$id || $id <= 0) {
            return redirect("/manage-user.html");
        }
        $data['UserInfo'] = ManageUser::getUserDetail($id);
        //menu - check menu
        $data['Menu'] = "mn-system";
        $data['Sub'] = "sub-list-users";

        return view('edit_user')->with('data', $data);
    }

    /*
     * process edit User info
     */

    public static function editUserAction(Request $request, $id)
    {
        $data['status'] = false;
        $data['msg'] = "Dữ liệu đầu vào không hợp lệ !";
        if (!isset($id) || !$id || $id <= 0) {
            return response()->json($data);
        }
        $parram['name'] = $request->input('name', '');
        $password = $request->input('password', '');
        if ($password) {
            $parram['password'] = bcrypt($password);
        }
        $parram['is_root'] = $request->input('is_root', '');
        $parram['updated_at'] = date("Y-m-d H:i:s");
        $edit = ManageUser::editUserInfo($id, $parram);
        if ($edit) {
            //add log
            $log['user_id'] = Auth::User()->id;
            $log['email'] = Auth::User()->email;
            $log['action'] = "Cập nhật thông tin 1 User có id = " . $id;
            $log['content'] = json_encode($parram);
            $log['created_at'] = date("Y-m-d H:i:s");
            $log['updated_at'] = date("Y-m-d H:i:s");
            $log['ip'] = $request->ip();
            ManageUserLogs::addLog($log);

            $data['status'] = true;
            $data['msg'] = "Cập nhật thông tin User thành công !!!";
            return response()->json($data);
        } else {
            $data['msg'] = "Lỗi khi cập nhật thông tin User !";
            return response()->json($data);
        }
    }

    /*
     * function delete 1 User
     */

    public static function deleteUser(Request $request, $user_id)
    {

        if (!isset($user_id) || !$user_id || $user_id <= 0) {
            return redirect("/manage-User.html");
        }
        $UserInfo = ManageUser::getUserDetail($user_id);
        $delete = ManageUser::deleteUser($user_id);
        if ($delete) {
            //add log
            $log['user_id'] = Auth::User()->id;
            $log['email'] = Auth::User()->email;
            $log['action'] = "Xóa 1 User có id = " . $user_id;
            $log['content'] = json_encode($UserInfo);
            $log['created_at'] = date("Y-m-d H:i:s");
            $log['updated_at'] = date("Y-m-d H:i:s");
            $log['ip'] = $request->ip();
            ManageUserLogs::addLog($log);
        }
        return redirect("/manage-user.html");
    }

}
