<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = Users::all()->toArray();
        foreach($users as &$item)
        {
            $user_role = UserRole::where('id',$item['user_role'])->get()->first();
            $item['user_role_name'] =$user_role['user_role_name'];
        }

        return array_reverse($users);
    }

    public function store(Request $request)
    {
        $User = new Users([
            'user_account' => $request->input('user_account'),
            'user_email' => $request->input('user_email'),
            'user_pwd' => Hash::make($request->input('user_pwd')),
            'user_role' => $request->input('user_role')
        ]);

        $User->save();

        return response()->json('使用者新增完畢');
    }

    public function show($id)
    {
        $user = Users::find($id);
        unset($user->user_pwd);

        return response()->json($user);
    }

    public function update($id,Request $request)
    {
        $user = Users::find($id);

        if($request->input('user_pwd'))
        {
            $user->user_pwd = Hash::make($request->input('user_pwd'));
        }
        $user->user_role = $request->input('user_role');
        $user->user_email = $request->input('user_email');

        $user->save();

        return response()->json('使用者更新完成');

    }
}
