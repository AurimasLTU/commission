<?php


namespace App\Http\Controllers;


class InputParseController
{
    function parseInput($request) {
        $transactions = (object) $request->all();

        return $transactions;
    }
}
