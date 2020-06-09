<?php


namespace App\Http\Controllers;


use Exception;

class BinParseController
{
    function getBin($bin) {
        $binResults = file_get_contents('https://lookup.binlist.net/' . $bin);

        if (!$binResults) {
            throw new Exception('Error occurred while retrieving bin data');
        }

        return json_decode($binResults);
    }
}
