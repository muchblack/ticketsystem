<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $user = Users::where('user_account',$request->input('user_account'))->first()->toArray();
        if($user)
        {
            if(Hash::check($request->input('user_pwd'), $user['user_pwd'])){
                $return_data = [
                    'id' => $user['id'],
                    'user_account' => $user['user_account'],
                    'user_role' => $user['user_role'],
                ];
                return response(json_encode($return_data),200);
            }
        }

        return response(json_encode(['Msg'=> '使用者或是密碼錯誤']), 401);
    }
}
