<?php /** @noinspection ALL */
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 9:27 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/AccountSignupManager.php';
use code\php\AccountSignupManager;


$asm = new AccountSignupManager();

if ($asm->doesAccountExist('keithloganbecker94@gmail.com') === false) {
    throw new Exception('unit test failed (doesAccountExist): account should exist ' .
        'keithloganbecker94@gmail.com');
}

if ($asm->canCreateAccount('keithloganbecker94@gmail.com') !== false ||
    $asm->canCreateAccount('keithloganbecker94@gmail.com') ===
    $asm->doesAccountExist('keithloganbecker94@gmail.com')) {
    throw new Exception('unit test failed (canCreateAccount): should have returned false ' .
        'or not matched result of does account exist.');
}