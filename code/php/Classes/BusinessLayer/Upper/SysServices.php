<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 11:59 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;


abstract class SysServices
{

    public static function isValidDateString($params)
    {
        if (!is_string($params['date'])) {
            throw new \Exception('SysServices::validateDateString() date must be set in params');
        }
        return preg_match('^\d\d\d\d-\d\d-\d\d$', $params['date']) === 1;
    }

}