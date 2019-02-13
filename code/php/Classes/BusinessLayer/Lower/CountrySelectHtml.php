<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 9:55 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Countries.php';
use code\php\Classes\BusinessLayer\Upper\Countries;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/SelectBuilder.php';
use code\php\Classes\BusinessLayer\Upper\SelectBuilder;

class CountrySelectHtml extends SelectBuilder
{

    private $countries;
    private $i = 0;
    private $selectVal;

    public function __construct($selectVal = '')
    {
        $this->countries = new \code\php\Classes\BusinessLayer\Upper\Countries();
        $this->countries = $this->countries->getCountries();
        $this->selectVal = $selectVal;
    }

    protected function getSelectClasses()
    {
        return 'countries';
    }

    protected function getOptionValue()
    {
        return $this->countries[$this->i];
    }

    protected function getOptionContent()
    {
        return $this->countries[$this->i];
    }

    protected function hasAnotherOption()
    {
        return count($this->countries) > $this->i;
    }

    protected function isSelected()
    {
        return $this->getOptionContent() === $this->selectVal;
    }

    protected function firstOptionContent()
    {
        return 'Select Country';
    }

    protected function next()
    {
        $this->i++;
    }
}