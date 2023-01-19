<?php

namespace Parser;

use Parser\Contracts\Curl;
use Exception;

class ResponseCurl implements Curl
{
    protected $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    // Получаем HTML сайта
    public function getResultCurl()
    {
        // подключаемся к сайту
        $headers = array(
            'cache-control: max-age=0',
            'upgrade-insecure-requests: 1',       
            'user-agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:93.0) Gecko/20100101 Firefox/93.0',       
            'sec-fetch-user: ?1',       
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',       
            'x-compress: null',        
            'sec-fetch-site: document',        
            'sec-fetch-mode: navigate',        
            'accept-encoding: deflate, br',        
            'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',        
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_URL, $this->link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


}