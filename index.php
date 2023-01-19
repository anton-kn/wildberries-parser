<?php
include "parser-html-php/autoload.php";

use Parser\Finder;
use Parser\DataBase\DB;
use Parser\FileDocument\Manipulation;

// $finder = new Finder();
// $finder->start('podguzniki');

$db = new DB();
$file = new Manipulation();
/**
 * !!! этот метод перенести в метод write()
 */
$file->setFileLocation('podguzniki');
// echo $db->insert("names", ["firstname"], ["Hello"])->execute();
// echo $db->insert("figure", ["size"])->value([125])->run();
$goods = $db->select(["urls", "names", "prices"], "podguzniki", "orderBy id desc");
foreach ($goods as $firstLevel) {
    foreach ($firstLevel as $secondLevel) {
        $file->writeFile($secondLevel);
    }
}
