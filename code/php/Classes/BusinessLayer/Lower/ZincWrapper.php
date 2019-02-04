<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 9:26 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/CurlWrapper.php';
use code\php\Classes\BusinessLayer\Upper\CurlWrapper;

use Exception;

class ZincWrapper
{

    private $curlWrapper;

    public function __construct()
    {
        $this->curlWrapper = new CurlWrapper();
    }

    public function buy($account, $zincCart)
    {
    }

    public function checkPrice()
    {
    }


}