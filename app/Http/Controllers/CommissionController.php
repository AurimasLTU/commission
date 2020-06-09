<?php


namespace App\Http\Controllers;


use App\Constants\EuropeanCountries;

use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class CommissionController
{
    private $binParse;
    private $inputParse;
    private $exchangeRateParse;

    public function __construct(BinParseController $binParseController,
                                InputParseController $inputParseController,
                                ExchangeRateParseController $exchangeRateParseController)
    {
        $this->inputParse = $inputParseController;
        $this->binParse = $binParseController;
        $this->exchangeRateParse = $exchangeRateParseController;
    }

    function calculateCommission(Request $request)
    {
        $transactions = $this->inputParse->parseInput($request);
        $responseArray = [];

        foreach ($transactions as $transaction) {
            try {
                $binObject = $this->binParse->getBin($transaction['bin']);
                $rate = $this->exchangeRateParse->getRate($transaction['currency']);
            } catch (Exception $exception) {
                return response($exception->getMessage(), 500);
            }

            if ($transaction['currency'] === 'EUR' or $rate == 0) {
                $amountFixed = $transaction['amount'];
            }

            if ($transaction['currency'] !== 'EUR' or $rate > 0) {
                $amountFixed = $transaction['amount'] / $rate;
            }

            $commission = ($amountFixed * ($this->isEu($binObject->country->alpha2) ? 0.01 : 0.02));
            $transaction['commission'] = ceil($commission * 100) / 100;
            $responseArray[] = $transaction;
        }

        return response()->json($responseArray, 200);
    }

    function isEu($country)
    {
        return in_array($country, EuropeanCountries::EU_COUNTRY_CODE_LIST);
    }
}
