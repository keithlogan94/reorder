<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 9:53 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysMethods.php';
use code\php\Classes\BusinessLayer\Upper\SysMethods;

class SysMethodsTest
{

    public function testValidHandleRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['apikey'] = 'ab4f1e8d-8de2-4bc4-9fbd-4868f61450f0';
        $_POST['method'] = 'createAccount';
        $_POST['className'] = 'AccountMethods';
        SysMethods::handleRequest();
    }

    public function testInvalidHandleRequest()
    {
        echo 'all good!';
    }


}