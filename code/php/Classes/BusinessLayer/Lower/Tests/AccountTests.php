<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 4:14 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Account.php';
use code\php\Classes\BusinessLayer\Upper\Account;

class AccountTests
{

    function testValidLoadByEmail()
    {
        $account = Account::loadByEmail('keithloganbecker94@gmail.com');
        echo $account->getPerson()->getData()->getFirstName();
    }

    function testValidGetPerson()
    {
        $account = Account::loadByEmail('keithloganbecker94@gmail.com');
        echo $account->getPerson()->getData()->getFirstName(). ' ' . $account->getPerson()->getData()->getLastName() . ' ';
        echo $account->getPerson()->getData()->getGender() . ' ' . $account->getPerson()->getData()->getMiddleName();
        echo $account->getPerson()->getData()->getPhoneNumber() . ' ' . $account->getPerson()->getData()->getBirthday();
    }

    function testValidDoesAccountExist()
    {
        if (!Account::doesAccountExist('keithloganbecker94@gmail.com')) {
            throw new Exception('failed to find email: keithloganbecker94@gmail.com');
        }
        if (Account::doesAccountExist('keithloganbecker94alsdkjfalskdjfalsdkfjalsdkj@gmail.com')) {
            throw new Exception('should not have found email');
        }
        echo 'all good';
    }

    function testSaveEmail()
    {
        $email = new \models\models\CrmEmail();
        $email->setCrmAccountId(1);
        $email->setEmailAddress('testemail22222@test.com');
        $email->save();
    }

    function testValidCreateAccount()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');

        $q = \models\models\CrmEmailQuery::create()->filterByEmailAddress($randEmail)->findOne();
        if (is_null($q)) throw new Exception('failed to create account');

        if (!Account::doesAccountExist($randEmail)) {
            throw new Exception('failed to create account '. $randEmail);
        }
    }

    function testAccountLoadByAccountId()
    {
        $account1 = Account::loadByEmail('keithloganbecker94@gmail.com');
        $account2 = new Account($account1->getCrmAccountId());

        if ($account1->getPerson()->getData()->getFirstName() !== $account2->getPerson()->getData()->getFirstName()) {
            throw new Exception('accounts do not match');
        }
    }

    function testAccountGetEmail()
    {
        $account = Account::loadByEmail('keithloganbecker94@gmail.com');
        $email = $account->getEmail()->getData()->getEmailAddress();

        if ($email !== 'keithloganbecker94@gmail.com') {
            throw new Exception('failed to get email');
        }
    }

    function testAccountSaveShippingAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasShippingAddress()) {
            throw new Exception('account should not have shipping address yet');
        }

        $account->saveShippingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasShippingAddress()) {
            throw new Exception('account should have shipping address');
        }
    }

    function testAccountGetShippingAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasShippingAddress()) {
            throw new Exception('account should not have shipping address yet');
        }

        $account->saveShippingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasShippingAddress()) {
            throw new Exception('account should have shipping address');
        }

        if ($account->getShippingAddress()->getData()->getStreet1() != '4240 Swanson Way'||
            $account->getShippingAddress()->getData()->getStreet2() != 'Unit 207'||
            $account->getShippingAddress()->getData()->getCity() != 'Castle Rock'||
            $account->getShippingAddress()->getData()->getState() != 'CO'||
            $account->getShippingAddress()->getData()->getCountry() != 'US'
        ) {
            throw new Exception('failed to get correct address');
        }
        echo $account->getShippingAddress()->getData()->getStreet1();
        echo $account->getShippingAddress()->getData()->getStreet2();
        echo $account->getShippingAddress()->getData()->getCity();
        echo $account->getShippingAddress()->getData()->getState();
        echo $account->getShippingAddress()->getData()->getCountry();
        echo $account->getShippingAddress()->getData()->getZip();
    }


    function testAccountSaveBillingAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasBillingAddress()) {
            throw new Exception('account should not have Billing address yet');
        }

        $account->saveBillingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasBillingAddress()) {
            throw new Exception('account should have Billing address');
        }
    }

    function testAccountGetBillingAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasBillingAddress()) {
            throw new Exception('account should not have Billing address yet');
        }

        $account->saveBillingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasBillingAddress()) {
            throw new Exception('account should have Billing address');
        }

        if ($account->getBillingAddress()->getData()->getStreet1() != '4240 Swanson Way'||
            $account->getBillingAddress()->getData()->getStreet2() != 'Unit 207'||
            $account->getBillingAddress()->getData()->getCity() != 'Castle Rock'||
            $account->getBillingAddress()->getData()->getState() != 'CO'||
            $account->getBillingAddress()->getData()->getCountry() != 'US'
        ) {
            throw new Exception('failed to get correct address');
        }
        echo $account->getBillingAddress()->getData()->getStreet1();
        echo $account->getBillingAddress()->getData()->getStreet2();
        echo $account->getBillingAddress()->getData()->getCity();
        echo $account->getBillingAddress()->getData()->getState();
        echo $account->getBillingAddress()->getData()->getCountry();
        echo $account->getBillingAddress()->getData()->getZip();
    }


    function testAccountSavePrimaryAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasPrimaryAddress()) {
            throw new Exception('account should not have Primary address yet');
        }

        $account->savePrimaryAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasPrimaryAddress()) {
            throw new Exception('account should have Primary address');
        }
    }

    function testAccountGetPrimaryAddress()
    {
        $randEmail = 'keith'.rand(0,10000000).'@gmail.com';
        $account = Account::createAccount($randEmail,'testFirstName','testLastName','testMiddleName',
            '8082258615','male');


        if ($account->hasPrimaryAddress()) {
            throw new Exception('account should not have Primary address yet');
        }

        $account->savePrimaryAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');

        if (!$account->hasPrimaryAddress()) {
            throw new Exception('account should have Primary address');
        }

        if ($account->getPrimaryAddress()->getData()->getStreet1() != '4240 Swanson Way'||
            $account->getPrimaryAddress()->getData()->getStreet2() != 'Unit 207'||
            $account->getPrimaryAddress()->getData()->getCity() != 'Castle Rock'||
            $account->getPrimaryAddress()->getData()->getState() != 'CO'||
            $account->getPrimaryAddress()->getData()->getCountry() != 'US'
        ) {
            throw new Exception('failed to get correct address');
        }
        echo $account->getPrimaryAddress()->getData()->getStreet1();
        echo $account->getPrimaryAddress()->getData()->getStreet2();
        echo $account->getPrimaryAddress()->getData()->getCity();
        echo $account->getPrimaryAddress()->getData()->getState();
        echo $account->getPrimaryAddress()->getData()->getCountry();
        echo $account->getPrimaryAddress()->getData()->getZip();
    }

}