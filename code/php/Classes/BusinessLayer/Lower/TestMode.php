<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 6:05 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysMethods.php';
use code\php\Classes\BusinessLayer\Upper\SysMethods;

use Exception;


class TestMode
{
    public function isEnabled()
    {
        return SysMethods::getConfig([
            'description' => 'Test Mode'
        ])['configValue'] === 'enabled';
    }

}