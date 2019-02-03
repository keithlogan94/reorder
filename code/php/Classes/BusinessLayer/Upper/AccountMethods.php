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

            echo json_encode($res);

        } catch (Exception $e) {
            throw new Exception('AccountMethods::createAccount() Failed to create account', 1, $e);
        }
    }


}