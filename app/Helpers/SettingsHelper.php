<?php
namespace App\Helpers;

use App\Models\Settings;
use App\Models\User;
class SettingsHelper{

    /*
     * return settings value
     */
    public static function getParram($name){
        if($setting = Settings::where(['name'=>$name])->first()){
            return $setting->attribute;
        }else{
            return '';
        }
    }

    public static function getUser($id){
        $userModelPath = config('admin.database.users_model');
        $userModel = new $userModelPath();
        $user = $userModel::select(['id', 'name', 'avatar'])->where(['id'=>$id])->first();
        return $user;
    }

}

