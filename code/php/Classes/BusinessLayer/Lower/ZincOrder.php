<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 9:21 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Account.php';
use code\php\Classes\BusinessLayer\Upper\Account;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/TestMode.php';
use code\php\Classes\BusinessLayer\Upper\TestMode;

class ZincOrder
{

    private $retailer;
    private $zincProductsToOrder = [];
    private $maxPrice;
    private $shippingAddress;
    private $billingAddress;
    private $isGift;
    private $giftMessage;
    private $retailerCredentials;
    private $shippingDetails;
    private $shippingMethod;
    private $paymentMethod;

    public function __construct($account)
    {
        $this->setShippingAndBillingAddresses($account);
        $this->setPaymentMethod($account);
        $this->setRetailerCredentials($account);
    }

    private function isZincOrderReadyForProcessing()
    {
        return $this->isAddressInformationSet() && $this->isPaymentMethodSet() &&
            $this->isShippingInstructionsSet() && !is_null($this->retailer) &&
            !empty($this->zincProductsToOrder) && !is_null($this->isGift) &&
            !is_null($this->retailerCredentials) && !is_null($this->giftMessage) &&
            !is_null($this->maxPrice);
    }

    public function addProductsToOrderByZincProductList($zincProductList)
    {
        if (!($zincProductList instanceof ZincProductList)) {
            throw new Exception('$zincProductList should be instance of ZincProductList');
        }
        /* @var $zincProductList ZincProductList*/
        $products = $zincProductList->getProducts();
        foreach ($products as $product) {
            /* @var $product ZincProduct*/
            if (!($product instanceof ZincProduct)) {
                throw new Exception('$product should be instance of ZincProduct');
            }
            if (!$product->isReadyToBeProcessedInOrder()) {
                throw new Exception('product added to ZincOrder is not ready to be processed in order');
            }
            $this->zincProductsToOrder[] = $product;
        }
    }

    private function setRetailerCredentials($account)
    {
        /* @var $account Account */
        if (!$account->hasAmazonLogin()) {
            throw new Exception('user '.$account->getEmail()->getData()->getEmailAddress().' does not have amazon login');
        }
        $this->retailerCredentials = array(
            'email' => $account->getAmazonLogin()->getData()->getLoginEmail(),
            'password' => $account->getAmazonLogin()->getData()->getLoginPassword()
        );
    }

    private function setPaymentMethod($account)
    {
        /* @var $account Account */
        if (!$account->hasCreditCard()) {
            throw new Exception('account does not have a credit card saved');
        }
        $this->paymentMethod = array(
            'name_on_card' => $account->getCreditCard()->getData()->getNameOnCard(),
            'number' => $account->getCreditCard()->getData()->getNumber(),
            'security_code' => $account->getCreditCard()->getData()->getSecurityCode(),
            'expiration_month' => $account->getCreditCard()->getData()->getExpirationMonth(),
            'expiration_year' => $account->getCreditCard()->getData()->getExpirationYear(),
            'use_gift' => false
        );
    }

    private function isPaymentMethodSet()
    {
        return !is_null($this->paymentMethod);
    }

    public function setShippingMethod($method)
    {
        if (!in_array($method, array('free','cheapest','fastest'))) {
            throw new Exception('unsupported shipping method');
        }
        $this->shippingDetails = null;
        $this->shippingMethod = $method;
    }

    public function setShippingDetails($orderByMethod, $maxDays, $maxPrice)
    {
        if (!in_array($orderByMethod, array('price','speed'))) {
            throw new Exception('unsupported order by method');
        }
        $this->shippingMethod = null;
        $this->shippingDetails = array(
            'order_by' => $orderByMethod,
            'max_days' => $maxDays,
            'max_price' => $maxPrice
        );
    }

    private function isShippingInstructionsSet()
    {
        return !is_null($this->shippingMethod) || !is_null($this->shippingDetails);
    }

    private function isAddressInformationSet()
    {
        return !is_null($this->shippingAddress) && !is_null($this->billingAddress);
    }

    private function setShippingAndBillingAddresses($account)
    {
        $this->setShippingAddress($account);
        $this->setBillingAddress($account);
    }

    private function setBillingAddress($account)
    {
        /* @var $account Account */
        if (!$account->hasBillingAddress()) {
            throw new Exception('account does not have billing address');
        }
        $this->billingAddress = array(
            'first_name' => $account->getPerson()->getData()->getFirstName(),
            'last_name' => $account->getPerson()->getData()->getLastName(),
            'address_line1' => $account->getBillingAddress()->getData()->getStreet1(),
            'address_line2' => $account->getBillingAddress()->getData()->getStreet2(),
            'zip_code' => $account->getBillingAddress()->getData()->getZip(),
            'city' => $account->getBillingAddress()->getData()->getCity(),
            'state' => $account->getBillingAddress()->getData()->getState(),
            'country' => $account->getBillingAddress()->getData()->getCountry(),
            'phone_number' => $account->getPerson()->getData()->getPhoneNumber()
        );
    }

    private function setShippingAddress($account)
    {
        /* @var $account Account */
        if (!$account->hasShippingAddress()) {
            throw new Exception('account does not have shipping address');
        }
        $this->shippingAddress = array(
            'first_name' => $account->getPerson()->getData()->getFirstName(),
            'last_name' => $account->getPerson()->getData()->getLastName(),
            'address_line1' => $account->getShippingAddress()->getData()->getStreet1(),
            'address_line2' => $account->getShippingAddress()->getData()->getStreet2(),
            'zip_code' => $account->getShippingAddress()->getData()->getZip(),
            'city' => $account->getShippingAddress()->getData()->getCity(),
            'state' => $account->getShippingAddress()->getData()->getState(),
            'country' => $account->getShippingAddress()->getData()->getCountry(),
            'phone_number' => $account->getPerson()->getData()->getPhoneNumber()
        );
    }

    public function getOrderArray()
    {
        if (!$this->isZincOrderReadyForProcessing()) {
            throw new Exception('zinc order is not ready for processing');
        }
        $products = [];
        foreach ($this->zincProductsToOrder as $product) {
            /* @var $product ZincProduct*/
            $products[] = $product->getOrderArray();
        }
        $testMode = new \code\php\Classes\BusinessLayer\Upper\TestMode();
        //if test mode is enabled then always set max price to 0 so that no transactions actually go through
        $this->maxPrice = $testMode->isEnabled() ? 0 : $this->maxPrice;
        return array(
            'retailer' => $this->retailer,
            'products' => $products,
            'max_price' => $this->maxPrice,
            'shipping_address' => $this->shippingAddress,
            'is_gift' => $this->isGift,
            'gift_message' => $this->giftMessage,
            (!is_null($this->shippingDetails) ? 'shipping':'shipping_method') =>
                (!is_null($this->shippingDetails) ? $this->shippingDetails : $this->shippingMethod),
            'payment_method' => $this->paymentMethod,
            'billing_address' => $this->billingAddress,
            'retailer_credentials' => $this->retailerCredentials
            /* possibly in the future have webhooks and client notes
            these fields are not required by zinc */
        );
    }






}