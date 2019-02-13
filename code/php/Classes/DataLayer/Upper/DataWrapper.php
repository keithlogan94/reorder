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

        $result = mysqli_query($conn, $params['sql']);

        if ($result === FALSE) {
            throw new Exception('DataBase::query() Query failed: ' . mysqli_error($conn));
        }

        if ($result === TRUE) return true;

        if (!isset($params['mode'])) $params['mode'] = 'getAllRows';

        $return = null;
        switch ($params['mode']) {
            case 'getSingleRow':
                $return = mysqli_fetch_assoc($result);
                break;
            case 'getAllRows':
                $rows = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                $return =  $rows;
                break;
            case 'getResult':
                $return = $result;
                break;
            default:
                throw new Exception('DataBase::query() Mode ' . $params['mode'] . ' not handled');
        }

        mysqli_close($conn);
        return $return;
    }
}