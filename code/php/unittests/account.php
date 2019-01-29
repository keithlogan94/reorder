<?php /** @noinspection ALL */
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 9:27 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/AccountSignupManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
use code\php\Database;
use code\php\AccountSignupManager;

/* @var $db Database*/
$db = \code\php\get_db();

$asm = new AccountSignupManager();

$result = $db->query('SELECT * FROM crm_account WHERE email_address = \'keithloganbecker94@gmail.com\';');
if (mysqli_num_rows($result) === 0) {
    throw new Exception('failed to find account keithloganbecker94@gmail.com: please fix that to run unit tests.');
}

if ($asm->doesAccountExist('keithloganbecker94@gmail.com') === false) {
    throw new Exception('unit test failed (doesAccountExist): account should exist ' .
        'keithloganbecker94@gmail.com');
}

if ($asm->doesAccountExist('alsdkfjaslkdjfalskdjflaskdjflaksjd1312@glkajsdf.com')) {
    throw new Exception('unit test failed (doesAccountExist): account should not exit.');
}

if ($asm->canCreateAccount('keithloganbecker94@gmail.com') !== false ||
    $asm->canCreateAccount('keithloganbecker94@gmail.com') ===
    $asm->doesAccountExist('keithloganbecker94@gmail.com')) {
    throw new Exception('unit test failed (canCreateAccount): should have returned false ' .
        'or not matched result of does account exist.');
}

$createAccountEmail = 'testaccount'.rand(1, 1000000).'@gmail.com';
if ($asm->doesAccountExist($createAccountEmail)) {
    throw new Exception('unit test failed (doesAccountExist):account should not exist: ' . $createAccountEmail);
}

$fname = 'Keith';
$lname = 'Becker';
$mname = 'Logan';
$phone = '808225615';
$street = '4240 Swanson Way';
$street2 = 'Unit 207';
$city = 'Castle Rock';
$zip = '80109';
$state = 'CO';
$country = 'US';
$accountType = 'personal';
$account = $asm->requestCreateAccount($accountType,$fname,$lname,$mname,
    $createAccountEmail,$phone,$street,$street2,$city,
    $zip,$state,$country);

if (!$asm->doesAccountExist($createAccountEmail)) {
    throw new Exception('unit test failed (requestCreateAccount): account should exist after ' .
        'creating the account with email: ' . $createAccountEmail);
}

if ($account->getFirstName() !== $fname
|| $account->getLastName() !== $lname
|| $account->getMiddleName() !== $mname
|| $account->getPhoneNumber() !== $phone
|| $account->getStreet1() !== $street
|| $account->getStreet2() !== $street2
|| $account->getCity() !== $city
|| $account->getZipCode() !== $zip
|| $account->getState() !== $state
|| $account->getCountry() !== $country
|| $account->getAccountType() !== $accountType) {
    var_dump($account);
    throw new Exception('unit test failed (requestCreateAccount): one or more values from creating account ' .
        'do not match');
}
session_start();
$_SESSION['okay_unit_tests'][] = 'account.php';
echo 'All unit tests ran okay!';
header('Location: http://localhost/code/php/unittests/index.php');