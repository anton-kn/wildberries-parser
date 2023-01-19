<?php

namespace Parser\DataBase\Migration;

use Parser\DataBase\ConnectDB;

class TableDB
{

    // храним соединение с БД
    public $db;

    private $sql;

    public function __construct()
    {
        $this->db = ConnectDB::connect();
    }

    public function table($name)
    {
        $this->sql = "CREATE TABLE {$name} (";
        return $this;
    }

    /**
     * добавляем таблицу
     */
    public function column($column)
    {
        $this->sql .= $column . ", ";
        return $this;
    }

    public function run()
    {   
        // Удаляем последнюю строку
        $this->sql = rtrim($this->sql, ', ') . ")". PHP_EOL;
        // return $this->sql;
        if($this->db->query($this->sql) === true){
            echo "Таблица создана!" . PHP_EOL;
        }else{
            echo "Ошибка: " . $this->error;
        }
    }
}