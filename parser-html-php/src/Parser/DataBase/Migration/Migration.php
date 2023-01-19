<?php

namespace Parser\DataBase\Migration;
/**
 * Класс для создания таблицы в БД
 */
class Migration extends TableDB
{
    public function __construct()
    {
        $this->table = new TableDB();
    }
    /**
     * Показываем информацию о хосте
     * */ 
    public function info()
    {
        echo $this->db->host_info . PHP_EOL;
    }

    public function startCreateTable()
    {
        $this->table->table('podguzniki')
        ->column('id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY')
        ->column('urls VARCHAR(1000) NULL')
        ->column('names VARCHAR(1000) NULL')
        ->column('prices INT(30) NULL')
        ->column('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP')
        ->run();

    }

}