<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 3:46 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysServices.php';
use code\php\Classes\BusinessLayer\Upper\SysServices;
use Exception;

class NonLoginMethods
{

    public static function getCountries($params)
    {
        try {
            $res = SysServices::getCountries($params);
            $json = json_encode($res);

            if (json_last_error()) {
                throw new Exception(json_last_error_msg());
            }
            echo $json;

        } catch (Exception $e) {
            throw new Exception('NonLoginMethods::getCountries() Failed to get countries', 1, $e);
        }
    }

}