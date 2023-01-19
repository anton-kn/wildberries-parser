<?php

namespace Parser\DataBase;

use Parser\DataBase\ConnectDB;

class DB
{
    /**
     * переменная для хранения символьных констант
     */
    private $strPrepare;

    /**
     * Переменная, в которой будут хранится данные для записи в БД
     */
    private $value;

    /**
     * Переменная, в которую записываем  sql-запрос для prepare
     */
    private $sql;

    /**
     * переменные для символьных констант
     */
    private const INT = 'i';

    private const STRING = 's';

    public function __construct()
    {
        $this->db = ConnectDB::connect();
    }

    public function insert($tableName, array $columns, array $values)
    {
        /**
         * переносим данные для записи в переменную класса
         * для дальней записи
         */
        $this->value = $values;

        $count = count($values);
        /**
         * формируем новую строку, но перед этим повторяем символ "?" и
         *   удаляем последний символ "," в конце строки 
         */
        $repeatN = rtrim(str_repeat("?,", $count), ",");

        // формируем sql-запрос
        // проверяем количество столбцов в переменной $columns
        if (count($columns) > 1) {
            // преобразуем массив в строку
            $this->sql = "INSERT INTO {$tableName}" . " (" . implode(",", $columns) . ") " . "VALUES" .  " (" . "{$repeatN}" . ")";
        } else {
            $this->sql = "INSERT INTO {$tableName} " . "(" . $columns[0] . ") " . "VALUES" .  " (" . "{$repeatN}" . ")";
        }


        return $this;
    }

    public function select(array $columnsName, string $tableName, ...$keyword)
    {
        /**
         * формируем строку для запроса в $this->value, а также для
         * вывода значений из БД в соответствии с количеством столбцов
         */

         //ORDERBY Country DESC;

        foreach ($columnsName as $key => $column) {
            $this->value .= $column . ",";
        }

        $this->value = rtrim($this->value, ",");

        $this->sql = "SELECT {$this->value} FROM {$tableName}";

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();

        $stmt->bind_result(...$columnsName);

        $arr = [];
        while ($stmt->fetch()) {
            $secondRow = [];
            foreach($columnsName as $key => $values){
                $secondRow[] = $values;
            }
            $arr[] = $secondRow;
        }
        
        $stmt->close();
    
        return $arr;
    }
    /**
     * Подготовка данных и запись в БД
     */
    public function execute()
    {
        /**
         * Проверяем количество элементов, которые необходимо записать
         * Если больше 1 - перебираем массив, если меньше сразу же обращаемся к 0-элементу
         */
        if (count($this->value) > 1) {
            foreach ($this->value as $key => $value) {
                /**
                 * переменная, в которой будет храниться символьная константа для prepered
                 */
                if (gettype($value) == "integer") {
                    $this->strPrepare .= self::INT;
                }

                if (gettype($value) == "string") {
                    $this->strPrepare .= self::STRING;
                }
            }
        } else {
            if (gettype($this->value[0]) == "integer") {
                $this->strPrepare = self::INT;
            }
            if (gettype($this->value[0]) == "string") {
                $this->strPrepare = self::STRING;
            }
        }

        /**
         * Производим подготовку и запись в БД
         */
        $stmt = $this->db->prepare($this->sql);
        
        echo $this->sql . PHP_EOL;
        if (!$stmt) { //если ошибка - убиваем процесс и выводим сообщение об ошибке.
            die("SQL Error: {$this->db->errno} - {$this->db->error}" . PHP_EOL);
        }

        $stmt->bind_param($this->strPrepare, ...$this->value);
       
        $res = $stmt->execute();
        if (!$res) { //если ошибка - убиваем процесс и выводим сообщение об ошибке.
            die("SQL Error: {$this->db->errno} - {$this->db->error}" . PHP_EOL);
        }
        $stmt->close();
        // Очищаем данные
        $this->value = null;
        $this->sql = null;
        $this->strPrepare = null;
    }
}
