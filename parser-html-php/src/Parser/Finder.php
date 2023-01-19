<?php

declare(strict_types=1);

namespace Parser;

use Parser\Configuration\Config;
use Parser\FileDocument\Manipulation;
use Parser\Security\Period;
use Parser\Message;
use Parser\DataBase\DB;
use FFI\Exception;

class Finder extends Message
{
    public function start(string $product)
    {
        $file = new Manipulation();
        // Устанавливаем, куда будем записывать данные
        $file->setFileLocation($product);
        $db = new DB();

        $page = 1;
        // запускаем цикл, т.е. проходим по всем страницам заданной ссылки
        while (true) {
            // выводим номер страницы
            echo "Page " . $page . "\n";

            $link = Config::getResources($page);

            $val = $file->readFile($link[$product]['json']['catalog']);

            // выходим из цикла, если закончились стараницы
            if ($val == '') {
                break;
            }
            // получаем общее количество продуктов на текущей странице
            $count = $file->jsonDecode()->leadUp('data/products')->count;

            for ($i = 0; $i < $count; $i++) {
                
                $brand = $file->leadUp('data/products/' . $i . '/brand')->content;
                // ищем продукт по наименованию 
                if ($brand == 'Pampers') {
                    // Вхождение строки в строку
                    $result = $file->leadUp('data/products/' . $i . '/name')->findstr('15+');
                    if ($result == true) {
                        $url = $file->leadUp('data/products/' . $i . '/id')
                            ->first("https://www.wildberries.ru/catalog/")
                            ->end("/detail.aspx?targetUrl=GP")->content;
                        $name = $file->leadUp('data/products/' . $i . '/name')
                            ->content;
                        $price = $file->leadUp('data/products/' . $i . '/salePriceU')
                            ->cuteStringEnd(2)
                            ->content;
                        $db->insert($product, ['urls', 'names', 'prices'], [$url, $name, $price])->execute();

                    }
                }
            }
            $page++;
            Period::intevalSecond(2);
        }

    }
}
