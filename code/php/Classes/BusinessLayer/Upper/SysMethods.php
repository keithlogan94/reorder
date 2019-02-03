<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 9:12 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;


// setup the autoloading
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// setup Propel
require_once $_SERVER['DOCUMENT_ROOT'] . '/generated-conf/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/SysWrapper.php';
use code\php\Classes\DataLayer\Upper\SysWrapper;


use Exception;


abstract class SysMethods
{

    public static function handleRequest()
    {
        if (empty($_POST)) {
            throw new Exception('SysMethods::handleRequest() $_POST is empty');
        }
        if (!isset($_POST['method'])) {
            throw new Exception('SysMethods::handleRequest() method must be sent with POST request');
        }
        if (!isset($_POST['className'])) {
            throw new Exception('SysMethods::handleRequest() className must be sent with POST request');
        }
        //check against api key
        if (!isset($_POST['apikey'])) {
            throw new Exception('SysMethods::handleRequest() apikey must be sent in the POST request');
        } else {
            //check that its valid
            $config = self::getConfig([
                'description' => 'ReOrder API Key'
            ]);
            if (!$config['found']) {
                throw new Exception('SysMethods::handleRequest() api key ReOrder API Key was not found');
            }
            if ($_POST['apikey'] !== $config['configValue']) {
                throw new Exception('SysMethods::handleRequest() sent api key does not match ReOrder API Key');
            }
        }



    }

    public static function getConfig($params)
    {
        if (!isset($params['key']) || !isset($params['description'])) {
            throw new Exception('SysMethods::getConfig() key or description must be set in params');
        }
         return SysWrapper::getConfig($params);
    }

}