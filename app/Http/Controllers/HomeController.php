<?php

namespace App\Http\Controllers;

use App\Services\Impressions\Impression;
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
        $impressions = Impression::all();
        return view('home', ['impressions' => $impressions]);
    }
}
