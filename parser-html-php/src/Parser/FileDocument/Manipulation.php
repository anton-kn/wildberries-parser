<?php 

namespace Parser\FileDocument;

use Parser\FileDocument\FileContent;

class Manipulation extends FileContent
{
    /**
     * Количество элементов
     */
    public $count;

    /**
     * ищем вхождение строки в строке
     */
    public function findstr(string $search)
    {
        return mb_strpos($this->content, $search);
    }

    /**
     * Подготовка к записи
     */
    public function leadUp($path)
    {
        $res = $this->getValuesArray($path);

        //Количество элементов
        if(gettype($res) == 'array'){
            $this->count = count($res);
        }
        
        return $this;
    }


    /**
     * Удаление конца строки
     */
    public function cuteStringEnd(int $length)
    {
        $this->content = substr($this->content, 0, -$length);
        return $this;
    }

    public function end(string $endStr)
    {
        $this->content .= $endStr;
        return $this;
    }

    public function first(string $firstStr)
    {
        $this->content = $firstStr . $this->content;
        return $this;
    }

}