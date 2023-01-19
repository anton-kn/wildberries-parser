<?php

namespace Parser;

use Parser\Contracts\Dom;
use Parser\FileContent;
use Parser\ResponseCurl;
use DOMDocument;
use DOMXPath;

class DocumentDom implements Dom
{
    protected $arr = [];
    protected $dom;

    public function __construct(){
        $this->dom = new DOMDocument();
    }

    /**
     * Загружаем DOM из файла
     */
    public function getDOMFile($file){
        $content = new FileContent();
        $page = $content->readFile($file);
        $this->dom->loadHTML($page);
        return $this->dom;
    }

    /**
     * Загружаем DOM из curl
     */
    public function getDOMCurl($link){
        $curl = new ResponseCurl($link);
        $page = $curl->getResultCurl();
        $this->dom->loadHTML($page);
        return $this->dom;
    }

    /**
     * Возваращает содержимое внтури тега
     */
    public function getContentTag(string $name){

        $elements = $this->dom->getElementsByTagName($name);
        foreach($elements as $element){
            $this->arr[] = trim($element->nodeValue, ' ');
        }

        return $this->arr;
    }

    public function getContentByClassAndTagName(string $tag, string $nameClass)
    {
        $xpath = new DOMXPath($this->dom);
        $elements = $xpath->query("//{$tag}[@class='{$nameClass}']");
        foreach($elements as $element){
            $this->arr[] = trim($element->nodeValue, ' ');
        }

        return $this->arr;
    }

}