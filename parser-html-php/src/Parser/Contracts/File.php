<?php
declare(strict_types=1);
/**
 * Работа с файлом
 */
namespace Parser\Contracts;

interface File
{   
    public function writeFile(string $value);

    public function readFile(string $file);
}