<?php

include "parser-html-php/autoload.php";

use Parser\DataBase\Migration\Migration;

$migration = new Migration();
echo $migration->startCreateTable();