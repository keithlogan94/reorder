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

    /**
     * @throws Exception
     */
    public static function handleRequest()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('SysMethods::handleRequest() REQUEST_METHOD must be POST');
            }
            if (empty($_POST)) {
                throw new Exception('SysMethods::handleRequest() $_POST is empty');
            }
            if (!isset($_POST['method'])) {
                throw new Exception('SysMethods::handleRequest() method must be sent with POST request');
            }
            if (!isset($_POST['className'])) {
                throw new Exception('SysMethods::handleRequest() className must be sent with POST request');
            }//check against api key
            if (!isset($_POST['apikey'])) {
                throw new Exception('SysMethods::handleRequest() apikey must be sent in the POST request');
            } else {
                $config = self::getConfig([
                    'description' => 'ReOrder API Key'
                ]);
                if ($_POST['apikey'] !== $config['configValue']) {
                    throw new Exception('SysMethods::handleRequest() sent api key does not match ReOrder API Key');
                }
            }

            $class = $_POST['className'];
            $method = $_POST['method'];

            if (!method_exists($class, $method)) {
                throw new Exception('SysMethods::handleRequest() requested method does not exist in ' . $class.'object');
            }

            $res = $class::$method($_POST);

            $response = json_encode($res);
            echo $response;

        } catch (Exception $e) {
            throw new Exception('SysMethods::handleRequest() Failed to handle Request', 1, $e);
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