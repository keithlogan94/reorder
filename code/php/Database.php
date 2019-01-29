<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/28/2019
 * Time: 12:32 PM
 */

namespace code\php;


class Database
{

    const DB_NAME = 'sms_shop';
    const DB_PASS = 'c4hahaven%jkb72rAs';
    const DB_USER = 'db_user1';
    const DB_HOST = 'localhost';

    private $link = null;

    private $failQueryRetryHandler = null;

    private $resultArray = [];
    private $SQLArray = [];

    public function __construct()
    {
        $this->link = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        $this->checkSuccessfulConnection();
    }

    public function __destruct()
    {
        mysqli_close($this->link);
    }

    /**
     * @param $SQL
     * @param $paramTypes
     * @param $paramValues
     * @return bool|\mysqli_result
     * @throws \Exception
     */
    public function preparedQuery($SQL, $paramTypes, $paramValues)
    {
        $this->SQLArray[] = $SQL;
        if (!is_string($paramTypes)) throw new \Exception('$paramTypes must be string');
        if (!is_array($paramValues)) throw new \Exception('$paramValues must be array');
        if (strlen($paramTypes) !== count($paramValues)) throw new \Exception('must have 1 ' .
            'char for each elem in param values array');
        $stmt = mysqli_prepare($this->link, $SQL);
        if ($stmt === FALSE) {
            if (is_callable($this->failQueryRetryHandler)) {
                call_user_func($this->failQueryRetryHandler, $this);
                $this->failQueryRetryHandler = null;
                return $this->preparedQuery($SQL, $paramTypes, $paramValues);
            } else {
                throw new \Exception('statement is false: '. mysqli_error($this->link));
            }
        }
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$paramValues);
        $success = mysqli_stmt_execute($stmt);
        if ($success === TRUE) {
            if (strpos($SQL, 'INSERT INTO') !== FALSE) return mysqli_insert_id($this->link);
            $result = mysqli_stmt_get_result($stmt);
            $this->resultArray[] = $result;
            mysqli_stmt_close($stmt);
            return $result;
        } else if ($success === FALSE) {
            throw new \Exception('Failed to execute prepared query: ' . mysqli_error($this->link));
        }
    }

    /**
     * @param $table
     * @param $column
     * @param $value
     * @param $valueType
     * @param $whereColumn
     * @param $whereColumnValue
     * @param $whereColumnType
     * @throws \Exception
     */
    public function updateSingleDBValue($table, $column, $value, $valueType, $whereColumn, $whereColumnValue, $whereColumnType)
    {
        if (!is_string($valueType)) throw new \Exception('valueType must be string');
        if (strlen($valueType) !== 1) throw new \Exception('valueType must be 1 char');
        /* @var $db Database */
        $db = get_db();
        $updateSQL = <<<SQL
UPDATE {$table} SET {$column} = ? WHERE {$whereColumn} = ?
SQL;
        $db->preparedQuery($updateSQL, $valueType.$whereColumnType, [$value, $whereColumnValue]);
    }


    /**
     * @param $table
     * @param $whereColumn
     * @param $whereValue
     * @param $whereValueType
     * @return array|null
     * @throws \Exception
     */
    public function getSingleRow($table, $whereColumn, $whereValue, $whereValueType)
    {
        if (!is_string($whereColumn)) throw new \Exception('$whereColumn must be string');
        /* @var $db Database */
        $db = get_db();
        $getSQL = <<<SQL
        SELECT * FROM {$table} WHERE {$whereColumn} = ? LIMIT 1
SQL;
        $result = $db->preparedQuery($getSQL, $whereValueType, [$whereValue]);
        return mysqli_fetch_assoc($result);
    }


    /**
     * @param $SQL
     * @return bool|\mysqli_result
     * @throws \Exception
     */
    public function query($SQL)
    {
        if (!is_string($SQL)) throw new \Exception('$SQL must be string');
        $this->SQLArray[] = $SQL;
        $result = mysqli_query($this->link, $SQL);
        if ($result === FALSE && is_callable($this->failQueryRetryHandler)) {
            call_user_func($this->failQueryRetryHandler, $this);
            $this->failQueryRetryHandler = null;
            $this->query($SQL);
        } else if ($result === FALSE) {
            throw new \Exception('query failed: ' . mysqli_error($this->link));
        }
        $this->resultArray[] = $result;
        if (strpos($SQL, 'INSERT INTO') !== FALSE) {
            $insertId = mysqli_insert_id($this->link);
            if (!is_integer($insertId)) throw new \Exception('failed to return last insert id');
            return $insertId;
        }
        return $result;
    }

    /**
     * @param $func
     * @throws \Exception
     */
    public function setFailQueryRetryHandler($func) {
        if (!is_callable($func)) throw new \Exception('fail query retry handler func is not callable');
        $this->failQueryRetryHandler = $func;
    }

    public function getHostInfo()
    {
        return mysqli_get_host_info($this->link);
    }

    /**
     * @throws \Exception
     */
    private function checkSuccessfulConnection()
    {
        if (is_null($this->link) || !$this->link) {
            $error = '';
            $error = "Error: Unable to connect to MySQL." . PHP_EOL;
            $error .= "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            $error .= "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            throw new \Exception($error);
        }
    }

}

if (!isset($GLOBALS['database'])) {
    $GLOBALS['database'] = new Database();
}

if (!function_exists('get_db')) {
    function get_db() {
        return $GLOBALS['database'];
    }
}




