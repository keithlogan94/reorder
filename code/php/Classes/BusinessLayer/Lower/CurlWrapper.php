<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 8:55 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;
use Exception;


class CurlWrapper
{

    public function post($url, $payload)
    {
        if (!is_array($payload)) throw new \Exception('$payload must be an array');
        $ch = curl_init( $url );
        $payload = json_encode($payload);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('json_encode failed with message: ' . json_last_error_msg());
        }
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}