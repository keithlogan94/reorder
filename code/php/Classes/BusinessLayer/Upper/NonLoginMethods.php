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

    public static function getCityStateCountryHtmlFromZip($params)
    {
        try {
            $res = SysServices::getCityStateCountryHtmlFromZip($params);
            $json = json_encode($res);

            if (json_last_error()) {
                throw new Exception(json_last_error_msg());
            }
            echo $json;

        } catch (Exception $e) {
            throw new Exception('NonLoginMethods::getCityStateCountryHtmlFromZip() Failed to get html', 1, $e);
        }
    }

    public static function validateInput($params)
    {
        /* validation already happens before reaching this point
        so just return okay response */
        echo json_encode(['valid' => true]);
    }

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