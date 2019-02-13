<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 9:46 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;


abstract class SelectBuilder
{

    abstract protected function getSelectClasses();

    abstract protected function getOptionValue();

    abstract protected function getOptionContent();

    abstract protected function hasAnotherOption();

    abstract protected function isSelected();

    abstract protected function firstOptionContent();

    abstract protected function next();

    public function getHtml()
    {
        $options = '<option value="">'.$this->firstOptionContent().'</option>';
        while ($this->hasAnotherOption()) {
            $s = $this->isSelected() ? 'selected' : '';
            $options .= '<option value="'.$this->getOptionValue().'" '.$s.'>'.$this->getOptionContent().'</option>';
            $this->next();
        }
        return '<select class="form-control '.$this->getSelectClasses().'">'.$options.'</select>';
    }

}