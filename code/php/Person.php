<?php


namespace code\php;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';


class Person
{
    private $accountId;
    private $firstName;
    private $lastName;
    private $middleName;
    private $birthday;
    private $gender;
    private $phoneNumber;
    private $emailAddress;
    private $verified;
    private $accountCreationDateTime;

    /**
     * Account constructor.
     * @param $accountIdOrEmail
     * @throws \Exception
     */
    public function __construct($accountIdOrEmail)
    {
        if (!is_integer($accountIdOrEmail) && !is_string($accountIdOrEmail)) {
            throw new \Exception('$accountId must be numeric.');
        }
        if (is_integer($accountIdOrEmail)) {
            $this->loadByAccountId($accountIdOrEmail);
        } else if (is_string($accountIdOrEmail)) {
            if (!strpos($accountIdOrEmail, '@')) throw new \Exception('email address must have @ character');
            $this->loadByEmail($accountIdOrEmail);
        }
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param $email
     * @param $phoneNumber
     * @param $gender
     * @param $birthday
     * @return bool|Person
     * @throws \Exception
     */
    public static function requestCreateAccount($firstName, $lastName, $middleName, $email,
                                          $phoneNumber, $gender, $birthday)
    {
        if (self::canCreateAccount($email)) {
            /* @var $db Database */
            $db = get_db();
            $result = $db->callStoredProcedure('insert_crm_account',
                [$firstName,$lastName,$middleName,$email,$phoneNumber,$gender,$birthday],
                'sssssss');
            return new Person($email);
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     * @throws \Exception
     */
    public static function doesAccountExist($email)
    {
        if (!strpos($email,'@')) throw new \Exception('improperly formtted email');
        /* @var $db Database*/
        $db = get_db();
        $loadData = $db->callStoredProcedure('get_account_by',
            ['email',$email],
            'ss');
        if (is_bool($loadData) || !is_array($loadData)) throw new \Exception('doesAccountExist() $loadData should be array');
        return count($loadData) > 0;
    }

    /**
     * @param $email
     * @return bool
     * @throws \Exception
     */
    public static function canCreateAccount($email)
    {
        return self::doesAccountExist($email) === false;
    }

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public function save()
    {
        /* @var $db Database */
        $db = get_db();
        $db->callStoredProcedure(
            'update_crm_account',
            [$this->firstName,$this->lastName,$this->middleName,$this->emailAddress,$this->phoneNumber,$this->gender,$this->birthday,$this->accountId],
            'sssssssi'
        );
    }

    /**
     * @param $accountId
     * @throws \Exception
     */
    public function loadByAccountId($accountId)
    {
        /* @var $db Database */
        $db = get_db();
        $loadData = $db->callStoredProcedure('get_account_by',
            ['accountId',$accountId],
            'ss');

        $this->accountId = $loadData[0]['crm_account_id'];
        $this->firstName = $loadData[0]['first_name'];
        $this->lastName = $loadData[0]['last_name'];
        $this->middleName = $loadData[0]['middle_name'];
        $this->birthday = $loadData[0]['birthday'];
        $this->gender = $loadData[0]['gender'];
        $this->phoneNumber = $loadData[0]['phone_number'];
        $this->emailAddress = $loadData[0]['email_address'];
        $this->verified = $loadData[0]['verified'] == 0 ? false : true;
        $this->accountCreationDateTime = $loadData[0]['account_creation_datetime'];
    }

    private function loadByEmail($accountIdOrEmail)
    {
        /* @var $db Database */
        $db = get_db();
        $loadData = $db->callStoredProcedure('get_account_by',
            ['email',$accountIdOrEmail],
            'ss');

        if (is_bool($loadData)) throw new \Exception('load data should not be bool');

        $this->accountId = $loadData[0]['crm_account_id'];
        $this->firstName = $loadData[0]['first_name'];
        $this->lastName = $loadData[0]['last_name'];
        $this->middleName = $loadData[0]['middle_name'];
        $this->birthday = $loadData[0]['birthday'];
        $this->gender = $loadData[0]['gender'];
        $this->phoneNumber = $loadData[0]['phone_number'];
        $this->emailAddress = $loadData[0]['email_address'];
        $this->verified = $loadData[0]['verified'] == 0 ? false : true;
        $this->accountCreationDateTime = $loadData[0]['account_creation_datetime'];
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param mixed $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getAccountCreationDateTime()
    {
        return $this->accountCreationDateTime;
    }

    /**
     * @param mixed $accountCreationDateTime
     */
    public function setAccountCreationDateTime($accountCreationDateTime)
    {
        $this->accountCreationDateTime = $accountCreationDateTime;
    }

}