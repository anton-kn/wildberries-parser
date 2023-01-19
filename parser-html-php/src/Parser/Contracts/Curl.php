<?php
declare(strict_types=1);

namespace Parser\Contracts;

interface Curl
{   
    /**
     * Возвращает результат Curl-запроса
     */
    public function getResultCurl();
}