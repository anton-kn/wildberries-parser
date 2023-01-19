<?php

namespace Parser\DataBase;

use mysqli;

class ConnectDB
{
    public static function connect()
    {
        $mysqli = new mysqli("127.0.0.1", "root", "", "test");

        if ($mysqli->connect_error) {
            die('Connection error: ' .  $mysqli->connect_error);
        } 
        return $mysqli;
    }
}
