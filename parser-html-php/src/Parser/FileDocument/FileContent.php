<?php

declare(strict_types=1);

namespace Parser\FileDocument;

use Parser\Contracts\File;
use Parser\Configuration\Config;
use Parser\NameGenerator;
use FFI\Exception;

class FileContent implements File
{
    /**
     * Хранится содержание прочитанного файла
     */
    protected $fileContent;

    /**
     * Место записи файла 
     */
    protected $fileLocation;

    /**
     * Имя файла
     */
    protected $fileName;

    /**
     * Ресурс для хранения файла
     */
    protected $fileResurse;

    /**
     * Переменная, в которой храним любой массив данных
     */
    protected $data = [];

    /**
     * Переменная, в которой храним любой тип данных
     */
    public $content;

    /**
     * Количество элементов
     */
    public $count;

    /**
     * Расположение и имя файла
     */
    public function setFileLocation(string $searchObject)
    {
        // Присваиваем имя файла
        $this->fileName = NameGenerator::name($searchObject, 'txt');
        //Путь, куда будут записываться данные
        $this->fileLocation = Config::$fileLocation . $this->fileName;
    }

    protected function write()
    {
        if (isset($this->fileResurse) == false) {
            $this->fileResurse = fopen($this->fileLocation, "w") or die("Unable to open file!");
            // var_dump($this->file);
            fwrite($this->fileResurse, $this->content . "\n");
            // fwrite($this->fileResurse, $this->content . "\n");
        } else {
            fwrite($this->fileResurse, $this->content . "\n");
            // fwrite($this->fileResurse, $this->content . "\n");
        }
    }

    public function writeFile($value = null)
    {
        // var_dump($this->content);
        if ($value == null) {
            if ($this->content == "") {
                die("Введите данные, которые необходимо записать \n");
            }
            $this->write();
        }

        if ($value != null) {
            $this->content = $value;
            $this->write();
        }
    }

    public function readFile(string $file)
    {
        $this->fileContent = file_get_contents($file);
        return $this->fileContent;
    }

    /**
     *  Декодируем json-файл
     */
    public function jsonDecode()
    {
        $this->data = json_decode($this->fileContent, true);
        return $this;
    }

    /**
     * Ищем значения из массива по ключам
     * В качестве аргументов функций вводим ключи, по которым необходимо получить данные.
     * @var string $keys ключи массива, например - 'data/num/0/name'
     */
    public function getValuesArray(string $keys)
    {
        //преобразуем путь в массив
        $chars = preg_split('#/#iu', $keys);
        $count = count($chars);
        $i = 0;
        $arrN = $this->data[$chars[$i]];
        // проходим по массиву
        // 1. записываем в веременную $arrN массив данных
        // 2. переписываем переменную новым массивом $arrN 
        while ($i < ($count - 1)) {
            $i++;
            $arrN = $arrN[$chars[$i]];
        }
        return $this->content = $arrN;
    }

    public function __destruct()
    {
        // закрываем файл
        if (is_resource($this->fileResurse)) {
            fclose($this->fileResurse);
            // return "Файл закрыт! Запись файла {$this->fileName} закончена.";
        }
    }
}
