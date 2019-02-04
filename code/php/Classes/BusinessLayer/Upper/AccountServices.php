<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 12:07 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Account.php';

use Exception;

abstract class AccountServices
{

    public static function createAccount($params)
    {
        try {
            if (!isset($params['firstName'])) {
                throw new Exception('AccountMethods::createAccount() firstName must be sent in request');
            }
            if (!is_string($params['firstName'])) {
                throw new Exception('AccountMethods::createAccount() firstName must be a string');
            }
            if (!isset($params['lastName'])) {
                throw new Exception('AccountMethods::createAccount() lastName must be sent in request');
            }
            if (!is_string($params['lastName'])) {
                throw new Exception('AccountMethods::createAccount() lastName must be a string');
            }
            if (!isset($params['email'])) {
                throw new Exception('AccountMethods::createAccount() email must be sent in request');
            }
            if (!is_string($params['email'])) {
                throw new Exception('AccountMethods::createAccount() email must be a string');
            }
            if (!isset($params['gender'])) {
                throw new Exception('AccountMethods::createAccount() gender must be sent in request');
            }
            if (!is_string($params['gender'])) {
                throw new Exception('AccountMethods::createAccount() gender must be a string');
            }
            if (isset($params['birthday'])) {
                if (!is_string($params['birthday'])) throw new Exception('AccountMethods::createAccount() birthday must be string');
                if (!SysServices::isValidDateString(['date' => $params['birthday']])) {
                    throw new Exception('AccountMethods::createAccount() date string is not valid');
                }
            }
            if (isset($params['phone'])) {
                if (!is_string($params['phone'])) throw new Exception('AccountMethods::createAccount() phone must be string');
            }
            if (isset($params['middleName'])) {
                if (!is_string($params['middleName'])) throw new Exception('AccountMethods::createAccount() middleName must be string');
            }

            $account = Account::createAccount($params['email'], $params['firstName'],$params['lastName'],$params['middleName'],
                $params['phone'],$params['gender']);

            return $account->getCrmAccountId();

        } catch (\Exception $e) {
            throw new \Exception('AccountServices::createAccount() Failed to create account', 1, $e);
        }
    }

    public static function saveAddress($params)
    {

        try {
            if (!is_numeric($params['accountId'])) {
                throw new \Exception('AccountServices::saveAddress() accountId must be provided');
            }
            if (!is_string($params['address1'])) {
                throw new \Exception('AccountServices::saveAddress() address1 must be provided');
            }
            if (!is_string($params['address2'])) {
                throw new \Exception('AccountServices::saveAddress() address2 must be provided');
            }
            if (!is_string($params['city'])) {
                throw new \Exception('AccountServices::saveAddress() city must be provided');
            }
            if (!is_string($params['state'])) {
                throw new \Exception('AccountServices::saveAddress() state must be provided');
            }
            if (!is_string($params['zip'])) {
                throw new \Exception('AccountServices::saveAddress() zip must be provided');
            }
            if (!is_string($params['country'])) {
                throw new \Exception('AccountServices::saveAddress() country must be provided');
            }
            if (!is_string($params['addressType'])) {
                throw new \Exception('AccountServices::saveAddress() addressType must be provided');
            } else {
                switch ($params['addressType']) {
                    case 'primary':
                    case 'billing':
                    case 'shipping':
                        break;
                    default:
                        throw new \Exception('AccountServices::saveAddress() invalid addressType');
                }
            }

            $account = new \code\php\Classes\BusinessLayer\Upper\Account($params['accountId']);

            switch ($params['addressType']) {
                case 'primary':
                    if ($account->hasPrimaryAddress())  {
                        $account->getPrimaryAddress()->getData()->setStreet1($params['address1']);
                        $account->getPrimaryAddress()->getData()->setStreet2($params['address2']);
                        $account->getPrimaryAddress()->getData()->setCity($params['city']);
                        $account->getPrimaryAddress()->getData()->setZip($params['zip']);
                        $account->getPrimaryAddress()->getData()->setCountry($params['country']);
                        $account->getPrimaryAddress()->getData()->setState($params['state']);
                        $account->getPrimaryAddress()->getData()->save();
                    } else {
                        $account->savePrimaryAddress($params['address1'],$params['address2'],$params['city'],$params['state'],$params['zip'],$params['country']);
                    }
                    break;
                case 'billing':
                    if ($account->hasBillingAddress()) {
                        $account->getBillingAddress()->getData()->setStreet1($params['address1']);
                        $account->getBillingAddress()->getData()->setStreet2($params['address2']);
                        $account->getBillingAddress()->getData()->setCity($params['city']);
                        $account->getBillingAddress()->getData()->setZip($params['zip']);
                        $account->getBillingAddress()->getData()->setCountry($params['country']);
                        $account->getBillingAddress()->getData()->setState($params['state']);
                        $account->getBillingAddress()->getData()->save();
                    } else {
                        $account->saveBillingAddress($params['address1'],$params['address2'],$params['city'],$params['state'],$params['zip'],$params['country']);
                    }
                    break;
                case 'shipping':
                    if ($account->hasShippingAddress()) {
                        $account->getShippingAddress()->getData()->setStreet1($params['address1']);
                        $account->getShippingAddress()->getData()->setStreet2($params['address2']);
                        $account->getShippingAddress()->getData()->setCity($params['city']);
                        $account->getShippingAddress()->getData()->setZip($params['zip']);
                        $account->getShippingAddress()->getData()->setCountry($params['country']);
                        $account->getShippingAddress()->getData()->setState($params['state']);
                        $account->getShippingAddress()->getData()->save();
                    } else {
                        $account->saveShippingAddress($params['address1'],$params['address2'],$params['city'],$params['state'],$params['zip'],$params['country']);
                    }
                    break;
            }
        } catch (\Exception $e) {
            throw new \Exception('AccountServices::saveAddress() Failed to save address', 1, $e);
        }
    }

    public static function saveCreditCard($params)
    {
        try {
            switch (false) {
                case is_numeric($params['accountId']):
                case is_string($params['card_number']):
                case is_string($params['exp_month']):
                case is_string($params['exp_year']):
                case is_string($params['name_on_card']):
                case is_string($params['sec_code']):
                    throw new Exception('AccountServices::saveCreditCard() not all values were sent correctly');
                    break;
                default:
            }/* TODO: possibly in the future run a test transaction on the credit card here before saving the credit card information */
            $account = new Account($params['accountId']);
            if ($account->hasCreditCard()) {
                $account->getCreditCard()->getData()->setNameOnCard($params['name_on_card']);
                $account->getCreditCard()->getData()->setNumber($params['card_number']);
                $account->getCreditCard()->getData()->setExpirationMonth($params['exp_month']);
                $account->getCreditCard()->getData()->setExpirationYear($params['exp_year']);
                $account->getCreditCard()->getData()->setSecurityCode($params['sec_code']);
            } else {
                $account->saveCreditCard($params['name_on_card'],
                    $params['card_number'], $params['exp_month'], $params['exp_year'],
                    $params['sec_code']);
            }
            return true;
        } catch (Exception $e) {
            throw new Exception('AccountServices::saveCreditCard() Failed to save credit card',1,$e);
        }
    }

    public static function findAccount($params)
    {
        try {
            if (!isset($params['email']) && !isset($params['accountId'])) {
                throw new \Exception('AccountServices::findAccount() email or accountId must be provided');
            }
            $account = null;
            switch (true) {
                case isset($params['email']):
                    $account = \code\php\Classes\BusinessLayer\Upper\Account::loadByEmail($params['email']);
                    break;
                case isset($params['accountId']):
                    $account = new \code\php\Classes\BusinessLayer\Upper\Account($params['accountId']);
                    break;
            }
            return [
                'accountId' => $account->getCrmAccountId(),
                'firstName' => $account->getPerson()->getData()->getFirstName(),
                'lastName' => $account->getPerson()->getData()->getLastName(),
                'middleName' => $account->getPerson()->getData()->getMiddleName(),
                'phone' => $account->getPerson()->getData()->getPhoneNumber(),
                'gender' => $account->getPerson()->getData()->getGender(),
                'birthday' => $account->getPerson()->getData()->getBirthday(),
                'email' => $account->getEmail()->getData()->getEmailAddress()
            ];
        } catch (\Exception $e) {
            throw new \Exception('AccountServices::findAccount() Failed to find account', 1, $e);
        }
    }

}