<?php

return [
    'api_key' 	        => env('OPENWAETHER_API_KEY', '5c3039fffc13a3b3587ff67acbec9c85'),
    'onecall_api_version'       => '2.5',
    'historical_api_version'    => '2.5',
    'forecast_api_version'      => '2.5',
    'polution_api_version'      => '2.5',
    'geo_api_version'   => '1.0',
    'lang' 		        => env('OPENWAETHER_API_LANG', 'tr'),
    'date_format'       => 'd/m/Y',
    'time_format'       => 'h:i A',
    'day_format'        => 'l',
    'temp_format'       => 'c'         // c for celcius, f for farenheit, k for kelvin
];
