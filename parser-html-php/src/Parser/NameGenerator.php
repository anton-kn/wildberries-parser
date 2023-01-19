<?php
declare(strict_types = 1);

/**
 * Формирует имена файлов
 */
namespace Parser;

class NameGenerator
{
    /**
     * содает имя
     * Формат: имя_дата
     */
    public static function name(string $nameFile, string $typeFile){
        $date = date("d.m.y_H:i");
        return $nameFile . '_'. $date . '.'. $typeFile;
    } 
}