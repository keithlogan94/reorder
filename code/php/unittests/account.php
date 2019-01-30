<?php /** @noinspection ALL */
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 9:27 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/AccountSignupManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Account.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/LoginCredentials.php';
use code\php\Database;
use code\php\AccountSignupManager;
use code\php\Account;
use code\php\LoginCredentials;

session_start();
while (($key = array_search('account.php', $_SESSION['okay_unit_tests'])) !== false) {
    unset($_SESSION['okay_unit_tests'][$key]);
}

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

if ($asm->canCreateAccount($createAccountEmail)) {
    throw new Exception('unit test failed (canCreateAccount): should not be able to create account: ' .
        $createAccountEmail);
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

$account = new \code\php\Account('keithloganbecker94@gmail.com');
$account2 = new Account($account->getCrmAccountId());

if ($account->getStreet1() !== $account2->getStreet1() || $account->getFirstName() !== $account2->getFirstName()) {
    throw new Exception('unit test failed (loadByEmail): failed to load info correctly');
}

$account = $asm->requestCreateAccount($accountType,$fname,$lname,$mname,
    'testlogincred'.rand(1,1000000).'@gmail.com',$phone,$street,$street2,$city,
    $zip,$state,$country);

$loginCredentials = new LoginCredentials();
if ($loginCredentials->hasLoginCredentials($account->getCrmAccountId())) {
    throw new Exception('unit test failed: (hasLoginCredentials): user should not have ' .
        'login credentials yet.');
}

$loginCredentials->generateLoginCredentials($account->getCrmAccountId(), 'test username', 'asdf');

if (!$loginCredentials->hasLoginCredentials($account->getCrmAccountId())) {
    throw new Exception('unit test failed (hasLoginCredentials): user should have login credentials.');
}

$loggedInAccount = $loginCredentials->processLogin($account->getEmailAddress(), 'asdf');

if (!$loginCredentials->isLoggedIn()) {
    throw new Exception('unit test failed (processLogin): should be logged in now');
}

if ($loggedInAccount->getEmailAddress() !== $account->getEmailAddress()) {
    throw new Exception('unit test failed (processLogin): returned account should match this account');
}

$loggedInAccount->getLoginCredentials()->endLogin();

if ($loggedInAccount->getLoginCredentials()->isLoggedIn()) {
    throw new Exception('unit test failed (endLogin): should not be logged in any more');
}

if ($loginCredentials->processLogin($account->getEmailAddress(), 'alsdkfjaslkd')) {
    throw new Exception('unit test failed (processLogin): should not have been able ' .
        'to login with bad credentials.');
}

if (!$loginCredentials->processLogin($account->getEmailAddress(), 'asdf')) {
    throw new Exception('unit test failed (processLogin): should have been able ' .
        'to login with good credentials.');
}

$loginCredentials->updateLoginCredentials('updated username', 'asdff');

$loginCredentials->endLogin();

if (!$loginCredentials->processLogin('updated username', 'asdff')) {
    throw new Exception('unit test failed (updateLoginCredentials): should have been able to login' .
        ' with updated login credentials.');
}

$loginCredentials->endLogin();

if ($loginCredentials->processLogin($account->getEmailAddress(), 'asdf')) {
    throw new Exception('unit test failed (processLogin): should not have been able to login ' .
        'with bad credentials.');
}

if (!$loginCredentials->processLogin($account->getEmailAddress(), 'asdff')) {
    throw new Exception('unit test failed (processLogin): should have been able to login ' .
        'with good credentials.');
}

if (!$loginCredentials->processLogin('asldkfjasdlkfjasdlkfj','asldkfjasdlfkj')) {
    throw new Exception('unit test failed (processLogin): should return true because already logged in');
}

if (!$loginCredentials->isLoggedIn()) {
    throw new Exception('unit test failed (isLoggedIn): should return that is logged in');
}


$_SESSION['okay_unit_tests'][] = 'account.php';
echo 'All unit tests ran okay!';
