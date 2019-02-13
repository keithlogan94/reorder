<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 7:09 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/CountrySelectHtml.php';
use code\php\Classes\BusinessLayer\Upper\CountrySelectHtml;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/StateSelectHtml.php';
use code\php\Classes\BusinessLayer\Upper\StateSelectHtml;


class Zip
{

    private $country;
    private $city;
    private $state;
    private $zip;
    private $stateShortCode;

    public function __construct($zip)
    {
        $this->zip = $zip;
        $this->load();
    }

    public function getCityStateCountryHTML()
    {
        $countryHtml = new \code\php\Classes\BusinessLayer\Upper\CountrySelectHtml($this->country);
        $countryHtml = $countryHtml->getHtml();
        $stateHtml = new StateSelectHtml($this->state);
        $stateHtml = $stateHtml->getHtml();
        $html = <<<HTML
            <div class="form-group col-md-4">
                  <label>Country</label>
                  <div class="country-container">
                  $countryHtml
                  </div>
              </div>
              <div class="form-group col-md-4">
                  <label for="inputState">State</label>
                  <div class="state-container">
                  $stateHtml
                  </div>
              </div>
              <div class="form-group col-md-6">
                  <label for="inputCity">City</label>
                  <input type="text" class="form-control" id="inputCity">
              </div>
HTML;

        return $html;

    }

    public function load()
    {
        $zip = $this->zip;
        $SQL =<<<SQL
SELECT Zipcode AS 'zip', s.name AS 'state', s.abv AS 'state_abv',z.City AS 'city',c.Name AS 'country'
FROM zipcode z
INNER JOIN state s ON z.State = s.abv AND s.country = z.Country
INNER JOIN country c ON s.country = c.Code OR s.country = c.Code2
WHERE Zipcode = '{$this->zip}'
;
SQL;

        $info = DataWrapper::query([
            'sql' => $SQL,
            'mode' => DataWrapper::MODE_GET_SINGLE_ROW
        ]);
        $this->zip = $info['zip'];
        $this->state = $info['state'];
        $this->stateShortCode = $info['state_abv'];
        $this->country = $info['country'];
        $this->city = $info['city'];
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getStateShortCode()
    {
        return $this->stateShortCode;
    }



}