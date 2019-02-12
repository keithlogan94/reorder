<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 11:59 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;
use models\models\CountryQuery;


abstract class SysServices
{

    public static function isValidDateString($params)
    {
        if (!is_string($params['date'])) {
            throw new \Exception('SysServices::validateDateString() date must be set in params');
        }
        return preg_match('/^\d\d\d\d-\d\d-\d\d$/', $params['date']) === 1;
    }
	
	public static function getCountries($params)
	{
		try {
			if (!is_array($params)) throw new Exception('SysServices::getCountries() $params must be an array');

			$q = CountryQuery::create()->filterByActive(TRUE)->find();

			$countries = [];
			foreach ($q as $country) {
			    $countries[] = $country->getName();
            }

			return $countries;

		} catch (Exception $e) {
            throw new Exception('SysServices::getCountries() Failed to get countries',1,$e);
		}
	}
	

}