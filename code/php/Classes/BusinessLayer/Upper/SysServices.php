<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 11:59 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Zip.php';
use code\php\Classes\BusinessLayer\Upper\Zip;
use Exception;


abstract class SysServices
{

    public static function isValidDateString($params)
    {
        if (!is_string($params['date'])) {
            throw new \Exception('SysServices::validateDateString() date must be set in params');
        }
        return preg_match('/^\d\d\d\d-\d\d-\d\d$/', $params['date']) === 1;
    }

    public static function getCityStateCountryHtmlFromZip($params)
    {
        if (!isset($params['zip'])) throw new Exception('zip not found');

        $zip = new Zip($params['zip']);

        return [
            'html' => $zip->getCityStateCountryHTML()
        ];

    }

	public static function getCountries($params)
	{
		try {
			if (!is_array($params)) throw new Exception('SysServices::getCountries() $params must be an array');

			$counties = DataWrapper::query([
			    'sql' => 'SELECT * FROM country',
                'mode' => 'getAllRows'
            ]);

			$return = [];
			foreach ($counties as $county) {
			    $return[] = [
			        'name' => $county['Name']
                ];
            }

			return $return;

		} catch (Exception $e) {
            throw new Exception('SysServices::getCountries() Failed to get countries',1,$e);
		}
	}
	

}