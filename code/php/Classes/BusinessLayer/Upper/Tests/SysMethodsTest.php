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
        echo 'jtest';
        throw new Exception('failed unit test');
    }

    public function testInvalidHandleRequest()
    {
        echo 'all good!';
    }


}