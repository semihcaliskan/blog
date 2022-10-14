<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RakibDevs\Weather\Weather;

class WeatherController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $wt = new Weather();

        $info = $wt->getCurrentByCity('bursa');
       // $info = $wt->getHistoryByCord(29.0833, 40.1667, '2022-10-12');  // Get current weather by city name
       // dd($info);
        return view('weather', compact('info'));
    }
}
