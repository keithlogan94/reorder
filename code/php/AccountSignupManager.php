<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 8:57 AM
 */

namespace code\php;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Account.php';


class AccountSignupManager
{


    /**
     * @param $accountType
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param $email
     * @param $phoneNumber
     * @param $street1
     * @param $street2
     * @param $city
     * @param $zipCode
     * @param $state
     * @param $country
     * @return bool|Account
     * @throws \Exception
     */
    public function requestCreateAccount($accountType, $firstName, $lastName, $middleName, $email,
                                         $phoneNumber, $street1, $street2, $city, $zipCode,
                                         $state, $country)
    {
        if ($this->canCreateAccount($email)) {
            return $this->createAccount($accountType, $firstName, $lastName, $middleName, $email,
                $phoneNumber, $street1, $street2, $city, $zipCode,
                $state, $country);
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     * @throws \Exception
     */
    public function canCreateAccount($email)
    {
        return $this->doesAccountExist($email) === false;
    }

    /**
     * @param $email
     * @return bool
     * @throws \Exception
     */
    public function doesAccountExist($email)
    {
        /* @var $db Database*/
        $db = get_db();
        $loadData = $db->callStoredProcedure('find_crm_account_by_email',
            [$email],
            's');
        return count($loadData) > 0;
    }

    /**
     * @param $accountType
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param $email
     * @param $phoneNumber
     * @param $street1
     * @param $street2
     * @param $city
     * @param $zipCode
     * @param $state
     * @param $country
     * @return Account
     * @throws \Exception
     */
    private function createAccount($accountType, $firstName, $lastName, $middleName, $email,
                                   $phoneNumber, $street1, $street2, $city, $zipCode,
                                   $state, $country)
    {

        /* @var $db Database */
        $db = get_db();
        $result = $db->callStoredProcedure('insert_crm_account',
            [$accountType,$firstName,$lastName,$middleName,$email,$phoneNumber,$street1,
                $street2,$city,$state,$zipCode,$country],
            'ssssssssssss');

        $accountId = $result[0]['last_insert_id'];

        if (!is_integer($accountId)) throw new \Exception('insert statement failed to return account id');

        return new Account($accountId);


    }


}