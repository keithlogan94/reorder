<?php


namespace code\php;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';


class Account
{

    private $crm_account_id;
    private $account_type;
    private $first_name;
    private $last_name;
    private $middle_name;
    private $email_address;
    private $phone_number;
    private $street1;
    private $street2;
    private $city;
    private $state;
    private $zip_code;
    private $country;

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    private function updateValue($key, $value)
    {
        /* @var $db Database */
        $db = get_db();
        $db->updateSingleDBValue('crm_account', $key, $value, 's', 'crm_account_id', $this->crm_account_id, 'i');
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @throws \Exception
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        $this->updateValue('first_name', $first_name);
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * @param mixed $account_type
     * @throws \Exception
     */
    public function setAccountType($account_type)
    {
        $this->account_type = $account_type;
        $this->updateValue('account_type', $account_type);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @throws \Exception
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        $this->updateValue('last_name', $last_name);
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * @param mixed $middle_name
     * @throws \Exception
     */
    public function setMiddleName($middle_name)
    {
        $this->middle_name = $middle_name;
        $this->updateValue('middle_name', $middle_name);
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * @param mixed $email_address
     * @throws \Exception
     */
    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
        $this->updateValue('email_address', $email_address);
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     * @throws \Exception
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
        $this->updateValue('phone_number', $phone_number);
    }

    /**
     * @return mixed
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * @param mixed $street1
     * @throws \Exception
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;
        $this->updateValue('street1', $street1);
    }

    /**
     * @return mixed
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param mixed $street2
     * @throws \Exception
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
        $this->updateValue('street2', $street2);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @throws \Exception
     */
    public function setCity($city)
    {
        $this->city = $city;
        $this->updateValue('city', $city);
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @throws \Exception
     */
    public function setState($state)
    {
        $this->state = $state;
        $this->updateValue('state', $state);
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @param mixed $zip_code
     * @throws \Exception
     */
    public function setZipCode($zip_code)
    {
        $this->zip_code = $zip_code;
        $this->updateValue('zip_code', $zip_code);
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @throws \Exception
     */
    public function setCountry($country)
    {
        $this->country = $country;
        $this->updateValue('country', $country);
    }

    /**
     * Account constructor.
     * @param $accountId
     * @throws \Exception
     */
    public function __construct($accountId)
    {
        if (!is_integer($accountId)) {
            throw new \Exception('$accountId must be numeric.');
        }
        $this->crm_account_id = $accountId;
        $this->load($accountId);
    }

    /**
     * @param $accountId
     * @throws \Exception
     */
    public function load($accountId)
    {
        /* @var $db Database */
        $db = get_db();
        $loadData = $db->getSingleRow('crm_account', 'crm_account_id', (int)$accountId, 'i');
        foreach ($loadData as $key => $val) {
            $this->{$key} = $val;
        }
    }

}