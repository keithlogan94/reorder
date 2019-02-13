<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/13/2019
 * Time: 9:21 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;

class States
{

    private $states = [];
    private $abvs = [];


    public function __construct()
    {
        $rows = DataWrapper::query([
            'sql' => "SELECT * FROM state WHERE is_state = 'y' AND country = 'US';",
            'mode' => DataWrapper::MODE_GET_ALL_ROWS
        ]);

        foreach ($rows as $state) {
            $this->states[] = $state['name'];
            $this->abvs[] = $state['abv'];
        }

    }

    public function getStates()
    {
        return $this->states;
    }


}