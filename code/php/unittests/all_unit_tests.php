<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/2/2019
 * Time: 12:59 PM
 */


namespace unittests;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/LoginCredentials.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Person.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Address.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/RestApi.php';

use code\php\Database;
use function code\php\get_db;
use code\php\LoginCredentials;
use code\php\Person;
use code\php\Address;
use code\php\RestApi;

class UnitTests {

    public function test_database_connects()
    {
        $db = new Database();
    }

    public function create_test_data_if_not_exists()
    {
        /* @var $db Database*/
        $db = get_db();
        $conn = $db->getConnection();
        $res = mysqli_query($conn, 'SELECT * FROM crm_account a INNER JOIN crm_email e ON a.crm_account_id = e.crm_account_id WHERE e.email_address = \'keithloganbecker94@gmail.com\'');
        if (mysqli_num_rows($res) === 0) {
            mysqli_query($conn, "CALL insert_crm_account('Keith','Becker','Logan','keithloganbecker94@gmail.com',NULL,'male',NULL);");
        }
    }

    public function test_call_stored_procedure()
    {
        /* @var $db Database*/
        $db = get_db();
        $conn = $db->getConnection();
        $res = mysqli_query($conn, 'SELECT * FROM crm_account a INNER JOIN crm_email e ON a.crm_account_id = e.crm_account_id WHERE e.email_address = \'keithloganbecker94@gmail.com\'');
        if (mysqli_num_rows($res) === 0) exit('failed to find account with email keithloganbecker94@gmail.com; please insert this account to run this unit test');

        $res = $db->callStoredProcedure('get_account_by', ['email','keithloganbecker94@gmail.com'], 'ss');

        if (is_bool($res)) throw new \Exception('should not have return boolean, should have returned account');

        if (count($res) === 0) throw new \Exception('stored procedure returned 0 rows');

        if ($res[0]['first_name'] != 'Keith') {
            throw new \Exception('row returned does not have Keith as first_name');
        }
    }

    public function test_does_account_exist()
    {
        /* @var $db Database*/
        $db = get_db();

        $res = mysqli_query($db->getConnection(), 'SELECT * FROM crm_account a INNER JOIN crm_email e ON a.crm_account_id = e.crm_account_id WHERE e.email_address = \'keithloganbecker94@gmail.com\'');
        if (mysqli_num_rows($res) === 0) throw new \Exception('test assertion failed: must have account keithloganbecker94@gmail.com saved to test this unit test');

        if (!Person::doesAccountExist('keithloganbecker94@gmail.com'))
            throw new \Exception('unit test failed('.__METHOD__.'): account should exist');

        if (Person::doesAccountExist('asldkfjalskdfjlaksjdf@alskdjfalsdkfj.com')) throw new \Exception('unit test failed('.__METHOD__.') account should not exist');

    }

    public function test_can_create_account()
    {
        if (Person::doesAccountExist('keithloganbecker94@gmail.com') && Person::canCreateAccount('keithloganbecker94@gmail.com')) {
            throw new \Exception('unit test failed ('. __METHOD__. ') should not be able to create account');
        }

        if (!Person::canCreateAccount('alkdsjflaksjdflaksdjflakjsdflkj@alsdkfjalskdjf.com')) {
            throw new \Exception('unit test failed ('.__METHOD__.') should be able to create account');
        }
    }

    public function test_create_account()
    {
        $rand = rand(0,100010101);
        $email = 'testaccount'.$rand.'@test.com';
        if (Person::canCreateAccount($email)) {
            $acc = Person::requestCreateAccount('TestFirstName','TestLastName','TestMiddleName',$email,NULL,'male',NULL);
            if (!($acc instanceof Person)) {
                throw new \Exception('unit test failed('.__METHOD__.') failed to return account object');
            }
            if (!Person::doesAccountExist($email)) {
                throw new \Exception('unit test failed('.__METHOD__.') account should exist after creation --> ' . $email);
            }
        }
    }

}






