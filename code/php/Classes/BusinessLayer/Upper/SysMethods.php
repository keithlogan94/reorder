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
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/AccountMethods.php';
use code\php\Classes\BusinessLayer\Upper\AccountMethods;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/AccountServices.php';
use code\php\Classes\BusinessLayer\Upper\AccountServices;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/NonLoginMethods.php';
use code\php\Classes\BusinessLayer\Upper\NonLoginMethods;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;


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

            /* dont let user pass in accountId
            we will get that from username and password passed in */
            if (isset($_POST['accountId'])) {
                unset($_POST['accountId']);
            }

            //figure out if request contains username and password to an account
            $requestContainsUsername = isset($_POST['reorder_username']) &&
			is_string($_POST['reorder_username']) && strlen($_POST['reorder_username']) > 0;
            $requestContainsPassword = isset($_POST['reorder_password']) &&
			is_string($_POST['reorder_password']) && strlen($_POST['reorder_password']) > 0;

            /* if request is trying to create an account or use a Non Login service
            then process the request else the request must contain a username and password to an account
            or it will fail
            */
			$isRequestToCreateAccount = $_POST['className'] === 'AccountMethods' && $_POST['method'] === 'createAccount';
			$isNonLoginService = $_POST['className'] === 'NonLoginMethods';
			if (!$isRequestToCreateAccount && !$isNonLoginService) {
				if (!$requestContainsUsername || !$requestContainsPassword) {
					throw new Exception('user cannot access any method except AccountServices::createAccount ' .
						' or a Non-Login Service if not providing username and password');
				}
				/* if request is not trying to create an account then
				we want to look up the current account 
				- this is so that no requests can be made to the server unless 
				they were sent on behalf of an existing account or to create a new account */
				$accountId = AccountServices::getAccountIdByReOrderUsernameAndPassword([
					'username' => $_POST['reorder_username'],
					'password' => $_POST['reorder_password']
				]);
				if ($accountId === false) {
					throw new Exception('user credentials were incorrect');
				}
				if (is_numeric($accountId)) {
					unset($_POST['reorder_password']);
					unset($_POST['reorder_username']);
					$_POST['accountId'] = $accountId;
				} else {
					throw new Exception('an error occurred getting accountId from user credentials');
				}					
			}

            //check if method exists in class and call it
            $class = $_POST['className'];
            $method = $_POST['method'];
            $nsClass = 'code\php\Classes\BusinessLayer\Upper\\'.$class;
            $classMethods = get_class_methods($nsClass);

            if (!in_array($method,$classMethods)) {
                throw new Exception('SysMethods::handleRequest() requested method does not exist in ' . $class.' object');
            }

            /* validate and sanitize any request value that comes in to $_POST
            with known validation types in database
            */
            $_POST = self::validateInput([
                'input' => $_POST
            ]);

            $nsClass::$method($_POST);

        } catch (Exception $e) {
            throw new Exception('SysMethods::handleRequest() Failed to handle Request', 1, $e);
        }
    }

    public static function validateInput($params)
    {
        try {
            if (!isset($params['input'])) throw new Exception('SysMethods::validateInput() input must be passed into params');
            $returnArr = [];
            foreach ($params['input'] as $key => $value) {
                if (is_array($value)) throw new Exception('SysMethods::validateInput() value of input must not be an array');

                $row = DataWrapper::query([
                    'sql' => "SELECT * FROM input_validation WHERE allowed_key = '$key';",
                    'mode' => DataWrapper::MODE_GET_SINGLE_ROW
                ]);

                if ($row === false) {
                    throw new Exception('SysMethods::validateInput() Failed to find allowed_key for ' . $key);
                }

                $validationType = $row['validation_type'];
                $regex = $row['regex'];

                switch ($validationType) {
                    case 'regex':
                        if (preg_match('/' . $regex . '/', $value) !== 1) {
                            throw new Exception('SysMethods::validateInput() Failed to pass validation for input ' . $key . ' with value ' . $value);
                        }
                        $returnArr[$key] = $value;
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            throw new Exception('SysMethods::validateInput() Failed to pass email validation for input ' . $key . ' with value ' . $value);
                        }
                        $returnArr[$key] = $value;
                        break;
                    case 'float':
                        if (is_numeric($value))
                            $returnArr[$key] = (float)$value;
                        else throw new Exception('SysMethods::validateInput() Failed to pass numeric validation for input ' . $key . ' with value ' . $value);
                        break;
                    case 'int':
                        if (is_numeric($value))
                            $returnArr[$key] = (int)$value;
                        else throw new Exception('SysMethods::validateInput() Failed to pass numeric validation for input ' . $key . ' with value ' . $value);
                        break;
                    default:
                        throw new Exception('SysMethods::validateInput() validation type not supported ' . $validationType);
                        break;
                }
            }
            return $returnArr;
        } catch (Exception $e) {
            throw new Exception('SysMethods::validateInput() Failed to validate input',1,$e);
        }
    }

    public static function getConfig($params)
    {
        if (!isset($params['key']) && !isset($params['description'])) {
            throw new Exception('SysMethods::getConfig() key or description must be set in params');
        }
         return SysWrapper::getConfig($params);
    }

    public static function getCountries(&$params)
    {
        $res = SysServices::getCountries($params);
        $json = json_encode($res);

        if (json_last_error()) {
            throw new Exception(json_last_error_msg());
        }
        echo $json;
    }


}