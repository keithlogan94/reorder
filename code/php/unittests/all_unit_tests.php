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

}






