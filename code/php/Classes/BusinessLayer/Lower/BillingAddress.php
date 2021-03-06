<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 1:27 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;

class BillingAddress
{

    private $q;
    private $account;

    public function __construct(&$account)
    {
        /* @var $account Account*/
        $this->account = $account;
        $q = \models\models\CrmAddressQuery::create()->filterByCrmAccountId($account->getCrmAccountId())
            ->filterByIsBilling(TRUE)
            ->filterByIsShipping(FALSE)
            ->findOne();
        if (is_null($q)) {
            throw new Exception('failed to load billing address by account id');
        }
        $this->q = $q;
    }

    private static function canCreateAddress($accountId)
    {
        $q = \models\models\CrmAddressQuery::create()->filterByCrmAccountId($accountId)
            ->filterByIsShipping(FALSE)
            ->filterByIsBilling(TRUE)
            ->findOne();
        return is_null($q);
    }

    public static function createAddress(&$account, $street1,$street2,$city,$state,$zip,$country)
    {
        /* @var $account Account*/
        if (!self::canCreateAddress($account->getCrmAccountId())) throw new Exception('primary address already exists');
        $address = new \models\models\CrmAddress();
        $address->setCrmAccountId($account->getCrmAccountId());
        $address->setStreet1($street1);
        $address->setStreet2($street2);
        $address->setCity($city);
        $address->setState($state);
        $address->setIsBilling(TRUE);
        $address->setBillingFirstName($account->getPerson()->getData()->getFirstName());
        $address->setBillingLastName($account->getPerson()->getData()->getLastName());
        $address->setCountry($country);
        $address->setZip($zip);
        $address->save();
        return new BillingAddress($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }

    public function getData()
    {
        return $this->q;
    }

}