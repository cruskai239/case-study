<?php

namespace App\Http\Controllers;

use App\Services\Impressions\Impression;
use App\Services\Weather\OpenWeatherInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impressions = Impression::where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $weatherInterface = new OpenWeatherInterface();
        $weather = $weatherInterface->GetWeatherInfo(34286);
        return view('home', ['impressions' => $impressions, 'weather' => $weather]);
    }

    public function get_ExportRecentActivity(Request $request){
        Impression::create(['event_name' => 'activity_exported', 'user_id' => \Auth::user()->id]);
        $impressions = Impression::where('user_id', \Auth::user()->id)->get();
        $impressionMap = $impressions->map(function(Impression $impression){
           $result = [
              'Timestamp' => $impression->created_at->format('Y-m-d H:i:s'),
              'User' => $impression->User->name,
              'Event' => $impression->event_name,
              'Data' => $impression->data ?: 'N/A'
           ];
           return $result;
        });
        //dd($impressionMap->toArray());
        \Excel::create('export-impressions', function($excel) use($impressionMap){
            $excel->sheet('Main', function($sheet) use($impressionMap){
                $sheet->fromArray($impressionMap->toArray());
            });
        })->download('xls');
    }
}
