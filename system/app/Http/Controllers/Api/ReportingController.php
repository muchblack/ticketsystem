<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Reporting;

class ReportingController extends Controller
{
    protected $_priority;
    protected $_severity;

    public function __construct()
    {
        $this->_priority = [
            '1' => '最優先',
            '2' => '普通',
            '3' => '暫緩',
        ];
        $this->_severity = [
            '1' => '最嚴重',
            '2' => '比較嚴重',
            '3' => '普通',
            '4' => '不算嚴重'
        ];
    }

    //取得所有report
    public function index()
    {
        $reports = Reporting::all()->toArray();
        foreach ($reports as &$item )
        {
            $user = Users::where('id',$item['created_user'])->get()->first();
            $item['report_user'] = $user['user_account'];

            $item['priority'] = $this->_priority[$item['report_priority']];
            $item['severity'] = $this->_severity[$item['report_severity']];
        }

        return array_reverse($reports);
    }

    public function store(Request $request)
    {
        $report = new Reporting([
            'report_title' => $request->input('report_title'),
            'report_type' => $request->input('report_type'),
            'report_states' => '0',
            'report_severity' => $request->input('report_severity'),
            'report_priority' => $request->input('report_priority'),
            'report_summary' => $request->input('report_summary'),
            'report_desc' => $request->input('report_desc'),
            'created_user' => $request->input('userId'),
            'updated_user' => $request->input('userId')
        ]);

        $report->save();

        return response()->json('新增問題完畢');
    }

    public function show($id)
    {
        $reporting = Reporting::find($id);

        return response()->json($reporting);
    }

    public function update($id,Request $request)
    {
        $report = Reporting::find($id);

        $report->report_title = $request->input('report_title');
        $report->report_type = $request->input('report_type');
        $report->report_states = $request->input('report_states');
        $report->report_severity = $request->input('report_severity');
        $report->report_priority = $request->input('report_priority');
        $report->report_summary = $request->input('report_summary');
        $report->report_desc = $request->input('report_desc');
        $report->updated_user = $request->input('userId');

        $report->save();

        return response()->json('問題修改完畢');
    }

    public function changeReportStates(Request $request)
    {
        $report = Reporting::where('id',$request->input('id'))->get()->first();

        $report->report_states = 1 ;
        $report->save();

        return response()->json('狀態已更新');
    }
}
