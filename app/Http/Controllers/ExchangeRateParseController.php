<?php


namespace App\Http\Controllers;


use Exception;

class ExchangeRateParseController
{
    function getRate($currency) {
        $rateResponse = file_get_contents('https://api.exchangeratesapi.io/latest');

        if (!$rateResponse) {
            throw new Exception('Error occurred while retrieving exchange rate data');
        }

        return @json_decode($rateResponse, true)['rates'][$currency];
    }
}
