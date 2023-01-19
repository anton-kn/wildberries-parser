<?php
declare(strict_types=1);

namespace Parser\Contracts;

/**
 * Интерфейс для работы с DOM
 */
interface Dom
{
    /**
     * Загружаем DOM из файла
     */
    public function getDOMFile(string $file);

    /**
     * Загружаем DOM из curl
     */
    public function getDOMCurl(string $link);

    /**
     * Возваращает содержимое внтури тега
     */
    public function getContentTag(string $name);

    /**
     * Возвращает содержание по наименованию класса
     * @param string $tag наименование тега элемента
     * @param string $nameClass имя класса
     */
    public function getContentByClassAndTagName(string $tag, string $nameClass);

   
}