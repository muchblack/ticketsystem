<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replys extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_id',
        'reply_desc',
        'reply_user'
    ];
}
