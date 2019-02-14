<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 12:09 PM
 */
 
 header('Access-Control-Allow-Origin: *');
 
 function get_user_error() {
	 if (isset($GLOBALS['user_error'])) {
		 return $GLOBALS['user_error'];
	 } else {
		 return false;
	 }
 }
 
 function set_user_error($error) {
	 if (isset($GLOBALS['user_error'])) throw new Exception('can\'t set user error if already set');
	 $GLOBALS['user_error'] = $error;
 }

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysMethods.php';
use code\php\Classes\BusinessLayer\Upper\SysMethods;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/TestMode.php';
use code\php\Classes\BusinessLayer\Upper\TestMode;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/DataWrapper.php';
use code\php\Classes\DataLayer\Upper\DataWrapper;

try {
    SysMethods::handleRequest();
} catch (Exception $e) {
    http_response_code(500);

	$errorMessages = [];
	do {
		$errorMessages[] = $e->getMessage();
	} while (($e = $e->getPrevious()) instanceof Exception);
	
	//possibly return error that user can be displayed to user
    $testMode = new TestMode();
    if ($testMode->isEnabled()) {
        //test mode is enabled
        if (get_user_error()) {
            $res = json_encode(['errors'=>$errorMessages, 'userError'=>get_user_error()]);
        } else {
            $res = json_encode(['errors'=>$errorMessages]);
        }
    } else {
        //live mode only send user errors not debugging errors
        $res = json_encode(['userError'=>get_user_error()]);
    }

	//log errors to database
    $errorLog = [
        'input' => $_POST,
        'exceptionMessages' => ['errors'=>$errorMessages, 'userError'=>get_user_error()]
    ];
	$errorLog = json_encode($errorLog);
	if (json_last_error() !== JSON_ERROR_NONE) $errorLog = 'json_encode error: ' . json_last_error_msg();
    DataWrapper::query([
        'sql' => "INSERT INTO error_log (json_error) VALUES ('$errorLog');",
        'modify_array' => [
            DataWrapper::MODIFY_QUERY_REMOVE_SINGLE_QUOTES
        ]
    ]);

    if (json_last_error() !== JSON_ERROR_NONE) exit('error: ' . json_last_error_msg());

    exit($res);
}
