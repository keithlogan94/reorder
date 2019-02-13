<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/13/2019
 * Time: 9:48 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/CountrySelectHtml.php';
use code\php\Classes\BusinessLayer\Upper\CountrySelectHtml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/StateSelectHtml.php';
use code\php\Classes\BusinessLayer\Upper\StateSelectHtml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Zip.php';
use code\php\Classes\BusinessLayer\Upper\Zip;


class HtmlTests
{

    public function testCountrySelectHtml()
    {

        $zip = new \code\php\Classes\BusinessLayer\Upper\CountrySelectHtml('United States');
        echo $zip->getHtml();

        $stateHtml = new StateSelectHtml('Colorado');
        echo $stateHtml->getHtml();

    }

    public function zipGetHtml()
    {
        $zip = new Zip('80109');
        echo $zip->getCityStateCountryHTML();
    }

}