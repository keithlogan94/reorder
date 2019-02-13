<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 9:57 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;

class Countries
{

    private $countries = [];

    public function __construct()
    {
        $countries = DataWrapper::query([
            'sql' => 'SELECT * FROM country',
            'mode' => DataWrapper::MODE_GET_ALL_ROWS
        ]);

        foreach ($countries as $country) {
            $this->countries[] = $country['Name'];
        }
    }

    public function getCountries()
    {
        return $this->countries;
    }


}