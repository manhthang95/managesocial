<?php

namespace App\Models;
use DB;

class ManageUserLogs 
{
   public static function addLog($data)
    {
       if(!isset($data) || !$data || empty($data)){
           return false;
       }
       return DB::table('user_logs')->insert($data);
   }
   
   public static function getAllLogs($filter)
   {
       if(!isset($filter) || !$filter || empty($filter)){
           return array();
       }
       $query =  DB::table('user_logs');
       if(isset($filter['user']) && $filter['user'] != "0"){
           if(is_numeric($filter['user'])){
             $query->where('user_id', '=', $filter['user']);  
           }else{
               $query->where('email', '=', $filter['user']);
           }
       }
       if(isset($filter['action']) && $filter['action'] != "0"){
           $query->where('action', 'like', '%'.$filter['action'].'%');
       }
       if(isset($filter['startdate']) && $filter['startdate'] != "0"){
           $query->where('time', '>=', $filter['startdate']);
       }
       if(isset($filter['enddate']) && $filter['enddate'] != "0"){
           $query->where('time', '<=', $filter['enddate']);
       }
       $query->orderBy('id', 'desc');
       return $query->paginate(20);
   }
   
   public static function countAllLogs($filter)
   {
       if(!isset($filter) || !$filter || empty($filter)){
           return array();
       }
       $query =  DB::table('user_logs');
       if(isset($filter['user']) && $filter['user'] != "0"){
           if(is_numeric($filter['user'])){
             $query->where('user_id', '=', $filter['user']);  
           }else{
               $query->where('email', '=', $filter['user']);
           }
       }
       if(isset($filter['action']) && $filter['action'] != "0"){
           $query->where('action', 'like', '%'.$filter['action'].'%');
       }
       if(isset($filter['startdate']) && $filter['startdate'] != "0"){
           $query->where('time', '>=', $filter['startdate']);
       }
       if(isset($filter['enddate']) && $filter['enddate'] != "0"){
           $query->where('time', '<=', $filter['enddate']);
       }
       return $query->count();
   }
   
   public static function detailUserLogs($id){
       if(!isset($id) || !$id || $id <= 0){
           return array();
       }
       $query =  DB::table('user_logs');
       $query->where("id", $id);
       return $query->first();
   }
}
?>
