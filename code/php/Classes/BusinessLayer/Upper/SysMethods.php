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

            if (isset($_POST['accountId'])) {
                unset($_POST['accountId']);
            }

            $requestContainsUsername = isset($_POST['reorder_username']) &&
			is_string($_POST['reorder_username']) && strlen($_POST['reorder_username']) > 0;
            $requestContainsPassword = isset($_POST['reorder_password']) &&
			is_string($_POST['reorder_password']) && strlen($_POST['reorder_password']) > 0;

			$isRequestToCreateAccount = $_POST['className'] === 'AccountServices' && $_POST['method'] === 'createAccount';

			if (!$isRequestToCreateAccount) {				
				if (!$requestContainsUsername || !$requestContainsPassword) {
					throw new Exception('user cannot access any method except AccountServices::createAccount ' .
						'if not providing username and password');
				}
				/* if request is not to create an account then 
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

            $nsClass::$method($_POST);

        } catch (Exception $e) {
            throw new Exception('SysMethods::handleRequest() Failed to handle Request', 1, $e);
        }
    }

    public static function getConfig($params)
    {
        if (!isset($params['key']) && !isset($params['description'])) {
            throw new Exception('SysMethods::getConfig() key or description must be set in params');
        }
         return SysWrapper::getConfig($params);
    }

}