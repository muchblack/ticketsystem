<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_account',
        'user_email',
        'user_pwd',
        'user_role'
    ];

//    protected $hidden = [
//        'user_pwd',
//    ];
}
