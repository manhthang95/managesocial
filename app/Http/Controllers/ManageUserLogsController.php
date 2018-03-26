<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\ManageUserLogs;
use Auth;

class ManageUserLogsController extends Controller
{

    var $info = array();

    public function __construct(){
        if(!Auth::check()){
            return redirect('/login.html');
        }
    }

    /*
     * function get login url
     */

    public static function viewAll(Request $request)
    {
        //khởi tạo giá trị mặc định filter
        $filter['user'] = '0';
        $filter['action'] = '0';
        $filter['startdate'] = '0';
        $filter['enddate'] = '0';
        //filter - export
        $data['user'] = '0';
        $data['action'] = '0';
        $data['startdate'] = '0';
        $data['enddate'] = '0';
        $data['filter_startdate'] = '0';
        $data['filter_enddate'] = '0';
        //get parram
        if ($request->has("user")) {
            $filter['user'] = $request->input("user", '');
            $data['user'] = $request->input("user", '');
        }
        if ($request->has("action")) {
            $filter['action'] = $request->input("action", '');
            $data['action'] = $request->input("action", '');
        }
        if ($request->has("startdate")) {
            $start = str_replace("_", "/", $request->input("startdate", ''));
            $filter['startdate'] = strtotime($start . " 00:00:00");
            $data['startdate'] = $start;
            $data['filter_startdate'] = $request->input("startdate", '');
        }
        if ($request->has("enddate")) {
            $end = str_replace("_", "/", $request->input("enddate", ''));
            $filter['enddate'] = strtotime($end . " 23:59:59");
            $data['enddate'] = $end;
            $data['filter_enddate'] = $request->input("enddate", '');
        }

        $data['AllLogs'] = ManageUserLogs::getAllLogs($filter);
        $data['total'] = ManageUserLogs::countAllLogs($filter);
        //menu - check menu
        $data['Menu'] = "mn-system";
        $data['Sub'] = "sub-list-user-logs";

        //đẩy sang view để append vào phân trang - xử lý lại phần thời gian phân trang
        $filter['startdate'] = ($request->input("startdate", '') ? $request->input("startdate", '') : "0");
        $filter['enddate'] = ($request->input("enddate", '') ? $request->input("enddate", '') : "0");
        $data['filter'] = $filter;

        return view('manage_user_logs')->with('data', $data);
    }

    /*
     * function view detail info users
     */

    public static function detailUserLogs(Request $request, $id)
    {
        if (!isset($id) || !$id || $id == "") {
            return redirect("/manage-user-logs.html");
        }

        $data['LogInfo'] = ManageUserLogs::detailUserLogs($id);
        if (!$data['LogInfo']) {
            return redirect("/manage-user-logs.html");
        }
        //menu - check menu
        $data['Menu'] = "mn-system";
        $data['Sub'] = "sub-list-user-logs";

        return view('detail_user_logs')->with('data', $data);
    }

}

?>