<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 4:25 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysServices.php';
use code\php\Classes\BusinessLayer\Upper\SysServices;

class SysServicesTest
{

    public function testGetCountries()
    {

        var_dump( SysServices::getCountries([]) );

        $q = \models\models\CrmAccountQuery::create()->find();
        foreach ($q as $country) echo $country->getCrmAccountId() . '<BR>';


    }

}