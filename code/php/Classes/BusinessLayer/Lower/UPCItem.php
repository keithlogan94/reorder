<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/5/2019
 * Time: 9:47 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;

class UPCItem
{

    private $title;

    public function __construct($upcNumber)
    {
        if (!is_numeric($upcNumber)) throw new Exception('upc number is not numeric');
        $this->load($upcNumber);
    }

    private function load($upc)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.upcitemdb.com/prod/trial/lookup?upc=$upc");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($ch);

        if (curl_error($ch)) {
            throw new Exception(curl_error($ch));
        }

        $decodedJson = json_decode($res, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('json error: ' . json_last_error_msg());
        }
        $this->title = $decodedJson['items'][0]['title'];

    }

    public function getTitle()
    {
        return $this->title;
    }

}