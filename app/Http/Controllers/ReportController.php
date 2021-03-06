<?php

namespace App\Http\Controllers;

use App\Http\Requests\Services\Reporting\ReportRequest;
use App\Services\Impressions\Impression;
use App\Services\Reporting\ReportCriteria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    public function post_GetReportData(ReportRequest $request)
    {
        ini_set('memory_limit', '-1');
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        $timeslice = $request->input('timeslice', 30);
        $reportCriteria =
            new ReportCriteria($request->input('eventNames', ['page_view']), $startDate, $endDate, false, $timeslice);
        $result = $reportCriteria->runReport();
        Impression::create(['event_name' => 'report_generated', 'user_id' => Auth::user()->id]);
        return response()->json($result);
    }

}
