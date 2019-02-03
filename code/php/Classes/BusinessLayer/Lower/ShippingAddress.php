<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 1:27 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

class ShippingAddress
{

    private $q;
    private $account;

    public function __construct(&$account)
    {
        /* @var $account Account*/
        $this->account = $account;
        $q = \models\models\CrmAddressQuery::create()->filterByCrmAccountId($account->getCrmAccountId())
            ->filterByIsBilling(FALSE)
            ->filterByIsShipping(TRUE)
            ->findOne();
        if (is_null($q)) {
            throw new Exception('failed to load shipping address by account id');
        }
        $this->q = $q;
    }

    private static function canCreateAddress($accountId)
    {
        $q = \models\models\CrmAddressQuery::create()->filterByCrmAccountId($accountId)
            ->filterByIsShipping(TRUE)
            ->filterByIsBilling(FALSE)
            ->findOne();
        return is_null($q);
    }

    public static function createAddress(&$account, $street1,$street2,$city,$state,$zip,$country)
    {
        /* @var $account Account*/
        if (!self::canCreateAddress($account->getCrmAccountId())) throw new Exception('primary address already exists');
        $address = new \models\models\CrmAddress();
        $address->setStreet1($street1);
        $address->setStreet2($street2);
        $address->setCity($city);
        $address->setIsShipping(TRUE);
        $address->setIsBilling(FALSE);
        $address->setShippingFirstName($account->getPerson()->getData()->getFirstName());
        $address->setShippingLastName($account->getPerson()->getData()->getLastName());
        $address->setState($state);
        $address->setCountry($country);
        $address->setZip($zip);
        $address->save();
        return new ShippingAddress($account);
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