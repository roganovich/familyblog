<?php
namespace App\Helpers;

use App\Models\Settings;
use App\Models\User;
class SettingsHelper{

    public static function getParram($name){
        return Settings::where(['name'=>$name])->first()->attribute;
    }

    public static function getUser($id){
        $userModelPath = config('admin.database.users_model');
        $userModel = new $userModelPath();
        $user = $userModel::select(['id', 'name', 'avatar'])->where(['id'=>$id])->first();
        return $user;
    }

}

