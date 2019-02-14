<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/12/2019
 * Time: 5:54 PM
 */

namespace code\php\Classes\DataLayer\Upper;

use Exception;

class DataWrapper
{

    const DATABASE = 'reorder';
    const USERNAME = 'reorder_db';
    const PASSWORD = 'c4hahaven%jkb72rAs';
    const HOST = 'localhost';

    const MODE_GET_ALL_ROWS = 1;
    const MODE_GET_SINGLE_ROW = 2;
    const MODE_GET_RESULT = 3;

    const MODIFY_QUERY_REMOVE_SINGLE_QUOTES = 1;
    const MODIFY_QUERY_ESCAPE = 2;

    public static function query($params)
    {
        if (!is_array($params)) {
            throw new Exception('DataWrapper::query() $params must be an array');
        }
        if (!is_string($params['sql'])) {
            throw new Exception('DataWrapper::query() sql must be set and a string in the params');
        }

        $conn = mysqli_connect(self::HOST,self::USERNAME,self::PASSWORD,self::DATABASE);

        if (!$conn) {
            throw new Exception('DataWrapper::query() Failed to connect: '.mysqli_connect_error());
        }

        if (is_array($params['modify_array'])) {
            if (in_array(self::MODIFY_QUERY_ESCAPE, $params['modify_array'])) {
                $params['sql'] = mysqli_real_escape_string($conn, $params['sql']);
            }
            if (in_array(self::MODIFY_QUERY_REMOVE_SINGLE_QUOTES, $params['modify_array'])) {
                $params['sql'] = str_replace("'",'',$params['sql']);
            }
        }

        $result = mysqli_query($conn, $params['sql']);

        if ($result === FALSE) {
            throw new Exception('DataBase::query() Query failed: ' . mysqli_error($conn));
        }

        if ($result === TRUE) return true;
        if (mysqli_num_rows($result) === 0) return false;

        if (!isset($params['mode'])) $params['mode'] = self::MODE_GET_ALL_ROWS;


        $return = null;
        switch ($params['mode']) {
            case self::MODE_GET_SINGLE_ROW:
                $return = mysqli_fetch_assoc($result);
                break;
            case self::MODE_GET_ALL_ROWS:
                $rows = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                $return =  $rows;
                break;
            case self::MODE_GET_RESULT:
                $return = $result;
                break;
            default:
                throw new Exception('DataBase::query() Mode ' . $params['mode'] . ' not handled');
        }

        mysqli_close($conn);
        return $return;
    }
}