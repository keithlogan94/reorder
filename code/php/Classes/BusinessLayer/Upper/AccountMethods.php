<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 11:32 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysServices.php';
use code\php\Classes\BusinessLayer\Upper\SysServices;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/AccountServices.php';
use code\php\Classes\BusinessLayer\Upper\AccountServices;

use Exception;

abstract class AccountMethods
{

    public static function createAccount($params)
    {
        try {
            $res = AccountServices::createAccount($params);
            $json = json_encode($res);

            if (json_last_error()) {
                throw new Exception(json_last_error_msg());
            }
            echo $json;

        } catch (Exception $e) {
            throw new Exception('AccountMethods::createAccount() Failed to create account', 1, $e);
        }
    }

    public static function saveCreditCard(&$params)
    {
        $res = AccountServices::saveCreditCard($params);
        $json = json_encode($res);

        if (json_last_error()) {
            throw new Exception(json_last_error_msg());
        }
        echo $json;
    }

    public static function saveAddress($params)
    {
        $res = AccountServices::saveAddress($params);
        $json = json_encode($res);

        if (json_last_error()) {
            throw new Exception(json_last_error_msg());
        }
        echo $json;
    }


}