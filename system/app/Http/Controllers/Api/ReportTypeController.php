<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportType;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
{
    protected  $_report_type;

    public function __construct()
    {
        $this->_report_type = [
            'Bug' => [
              'name' => 'Bug',
              'value' => 1
            ],
            'FR' => [
                'name' => 'Feature Request',
                'value' => 2,
            ],
            'TC' => [
                'name' => 'Test Case',
                'value' => 3,
            ]
        ] ;
    }

    //
    public function index()
    {

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

    public function getReportTypeByRole($id)
    {
        $return_data = [];

        switch($id)
        {
            case 1: // Administrator
                $return_data = $this->_report_type;
                break;
            case 2: // PM
                $return_data = [
                    'FR' => [
                        'name' => 'Feature Request',
                        'value' => 2,
                    ],
                ];
                break;
            case 3: // QA
                unset($this->_report_type['FR']);
                $return_data = $this->_report_type;
                break;
            case 4: // RD
                unset($this->_report_type['TC']);
                break;
        }

        return $return_data;
    }
}
