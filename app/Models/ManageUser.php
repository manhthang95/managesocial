<?php

namespace App\Models;
use DB;

class ManageUser 
{
   public static function getListUser()
    {
       $query =  DB::table('users');
       $query->orderBy('id', 'desc');
       return $query->paginate(20);
   }

   public static function getTotalUser()
    {
       $query =  DB::table('users');
       return $query->count();
   }
   
   public static function getUserDetail($id)
    {
       if(!isset($id) || !$id || $id <= 0){
           return array();
       }
       return DB::table('users')->where('id', $id)->first();
   }

    public static function addNewUser($data)
    {
       if(!isset($data) || !$data || empty($data)){
           return false;
       }
       return DB::table('users')->insertGetId($data);
   }
   
   public static function editUserInfo($id, $data)
    {
       if(!isset($id) || !$id || $id <= 0 || !isset($data) || !$data || empty($data)){
           return false;
       }
       return DB::table('users')->where('id', $id)->update($data);
   }
   
   public static function addLog($data)
    {
       if(!isset($data) || !$data || empty($data)){
           return false;
       }
       return DB::table('user_logs')->insert($data);
   }
   
      /*
    * function hash password
    */
   public static function hash($password)
    {
            $options = array('cost' => 8);
            return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /*
    * funciton verify password
     * truyền thẳng vào chuỗi user nhập  và chuỗi mã hóa lưu ở db
    */
    public static function verify($plainPass, $hashPass)
    {
            return password_verify($plainPass, $hashPass);
    }
    
    public static function deleteUser($user_id)
    {
       if(!isset($user_id) || !$user_id || $user_id <= 0){
           return false;
       }
       return DB::table('users')->where('id', $user_id)->delete();
   }
}
