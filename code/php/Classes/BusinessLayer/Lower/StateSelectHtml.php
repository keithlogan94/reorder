<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/13/2019
 * Time: 9:20 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/SelectBuilder.php';
use code\php\Classes\BusinessLayer\Upper\SelectBuilder;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/States.php';
use code\php\Classes\BusinessLayer\Upper\States;

class StateSelectHtml extends SelectBuilder
{

    private $states = [];
    private $i = 0;
    private $selectedVal;

    public function __construct($selectedVal = '')
    {
        $this->selectedVal = $selectedVal;
        $this->states = new States();
        $this->states = $this->states->getStates();
    }

    protected function getSelectClasses()
    {
        return "states";
    }

    protected function getOptionValue()
    {
        return $this->states[$this->i];
    }

    protected function getOptionContent()
    {
        return $this->states[$this->i];
    }

    protected function hasAnotherOption()
    {
        return count($this->states) > $this->i;
    }

    protected function isSelected()
    {
        return $this->getOptionContent() === $this->selectedVal;
    }

    protected function firstOptionContent()
    {
        return "Select State";
    }

    protected function next()
    {
        $this->i++;
    }

}