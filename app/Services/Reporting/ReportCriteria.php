<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 9/19/2017
 * Time: 9:43 PM
 */

namespace App\Services\Reporting;

use App\Services\Impressions\Impression;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReportCriteria
{
    public $eventNames = [];
    /** @var Carbon $startDateTime */
    public $startDateTime = null;
    /** @var Carbon $endDateTime */
    public $endDateTime = null;
    public $page = false;
    public $timeslice = 5;

    public function __construct($eventNames = [], $startDateTime = null, $endDateTime = null, $page = false, $timeslice = 30)
    {
        $this->eventNames = $eventNames;
        $this->startDateTime = $startDateTime ?: Carbon::today('UTC')->startOfDay();
        $this->endDateTime = $endDateTime ?: Carbon::now('UTC');
        $this->page = $page;
        $this->timeslice = $timeslice;

    }

    /**
     * Runs the report for the specified criteria.
     *
     * Note: The rollups can be done with a Stored Procedure; however, I did this in Laravel to prove
     *       my ability to work with Laravel data types.
     */
    public function runReport()
    {
        ini_set('max_execution_time', '-1');


        /** @var Collection $impressions */
        $impressions = Impression::whereBetween('created_at', [$this->startDateTime, $this->endDateTime])
            ->whereIn('event_name', $this->eventNames)
            ->get();



        $slices = $this->EachSlice();
        $rollupNoZero = $impressions->map(function(Impression $impression){
           $obj = new \stdClass();
           /** @var Carbon $created */
           $created = $impression->created_at;
           $created->second(0);
           $created->addMinutes(-1 * $created->minute % $this->timeslice);

           $obj->created_at = $created;

           $obj->event_name = $impression->event_name;
           $obj->data = $impression->data;
           return $obj;
        });

        $result = new ReportResult();
        $result->labels = $this->eventNames;
        $result->ykeys = $this->eventNames;
        foreach ($slices as $slice){

            $arr = [ 'slice' => $slice->format('Y-m-d H:i')];
            foreach($this->eventNames as $eventName){
                $arr[$eventName] = $rollupNoZero->where('created_at', $slice)->where('event_name', $eventName)->count();
            }
            array_push($result->data, (object) $arr);
        }
        return $result;
    }

    protected function EachSlice()
    {

        $results = [];
        $slice = $this->startDateTime->copy();

        while($slice->diffInMinutes($this->endDateTime, false) > 0){
            array_push($results, $slice->copy());
            $slice = $slice->addMinutes($this->timeslice);

            //dd($slice->diffInMinutes($this->endDateTime));
        }


        //dd(count($results), $results);
        return $results;
    }
}