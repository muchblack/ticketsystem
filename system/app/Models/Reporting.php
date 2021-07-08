<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    use HasFactory;
    protected  $table = 'reportings';
    protected  $fillable = [
        'report_title',
        'report_type',
        'report_states',
        'report_summary',
        'report_severity',
        'report_priority',
        'report_desc',
        'created_user',
        'updated_user',
    ];
}
