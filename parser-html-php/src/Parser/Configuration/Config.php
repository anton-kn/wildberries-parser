<?php

declare(strict_types=1);

namespace Parser\Configuration;

/**
 * Класс ручной настройки данных необходимых для парсинга
 */
class Config
{
    public static $fileLocation = __DIR__ . '/../../../files/';

    public static $pathImg = '/../../../file/img/';

    public static function getResources($page)
    {
        return [
            'podguzniki' =>
            [
                'page' => 'https://www.wildberries.ru/catalog/detyam/tovary-dlya-malysha/podguzniki/podguzniki-detskie?sort=popular&cardsize=c516x688&page=' . $page,
                'json' =>
                [
                    'catalog' => 'https://catalog.wb.ru/catalog/children_things/catalog?appType=1&cardsize=c516x688&couponsGeo=12,3,18,15,21&curr=rub&dest=-1029256,-102269,-1278703,-1255563&emp=0&lang=ru&locale=ru&page=' . $page . '&pricemarginCoeff=1.0&reg=0&regions=68,64,83,4,38,80,33,70,82,86,75,30,69,48,22,1,66,31,40,71&sort=popular&spp=0&stores=117673,122258,122259,125238,125239,125240,6159,507,3158,117501,120602,120762,6158,121709,124731,159402,2737,130744,117986,1733,686,132043&subject=814;1469',
                    'catalog2' => 'https://catalog.wb.ru/catalog/children_things/catalog?appType=1&couponsGeo=2,12,7,3,6,18,21&curr=rub&dest=-1075831,-115134,-954515,-971633&emp=0&lang=ru&locale=ru&page=' . $page . '&pricemarginCoeff=1.0&reg=0&regions=64,83,4,38,80,33,70,82,86,30,69,22,66,31,40,1,48&sort=popular&spp=0&subject=814;1469'
                ]
            ],
        ];
    }
}
