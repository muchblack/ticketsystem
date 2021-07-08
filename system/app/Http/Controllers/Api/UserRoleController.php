<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    //
    public function index()
    {
        $userrole = UserRole::all()->toArray();

        return $userrole;
    }

    public function store()
    {

    }

    public function show($id)
    {

    }

    public function update($id,Request $request)
    {

    }
}
