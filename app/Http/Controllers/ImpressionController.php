<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 9/19/2017
 * Time: 8:25 PM
 */

namespace App\Http\Controllers;
use App\Http\Requests\Services\Impressions\ImpressionRequest;
use App\Services\Impressions\Impression;
use Illuminate\Http\Request;

class ImpressionController extends Controller
{
    /**
     * Creates an impression in the database.
     * Can be accessed via both GET and POST for convenience.
     * @param ImpressionRequest $request
     * @return string The 200 response is more important than the actual result.
     */
    public function request_MakeImpression(ImpressionRequest $request){
        $params = $request->all();
        $user = \Auth::user();
        $params['user_id'] = isset($user) ? \Auth::user()->id : 2;
        Impression::create($params);

        //dd(Impression::all());
        return 'success';
    }








}