<?php
declare(strict_types=1);

namespace Parser\Security;


/**
 * Класс для настройки запросов по времени
 */
class Period
{
    public static function intevalSecond(int $second){
        sleep($second);
    }

}
