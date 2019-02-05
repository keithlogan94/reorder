<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 3:11 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysMethods.php';
use code\php\Classes\BusinessLayer\Upper\SysMethods;

use Exception;

class ZincAPIKey
{
    /* @var $apiKey string*/
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = (string)SysMethods::getConfig([
            'description' => 'Zinc API Key'
        ])['configValue'];
    }

    public function __toString()
    {
        return $this->apiKey;
    }


}