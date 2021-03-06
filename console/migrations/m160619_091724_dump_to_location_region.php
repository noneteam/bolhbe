<?php

use yii\db\Migration;

class m160619_091724_dump_to_location_region extends Migration
{

    private $table_name = 'location_region';

    private $values = [
        '1' => 'Без региона',
        '4' => 'Республика Алтай',
        '5' => 'Республика Дагестан',
        '6' => 'Республика Ингушетия',
        '7' => 'Кабардино-Балкарская Республика',
        '8' => 'Республика Калмыкия',
        '10' => 'Республика Карелия',
        '11' => 'Республика Коми',
        '12' => 'Республика Марий Эл',
        '14' => 'Республика Саха (Якутия)',
        '15' => 'Республика Северная Осетия (Алания)',
        '17' => 'Республика Тыва',
        '19' => 'Республика Хакасия',
        '22' => 'Алтайский край',
        '26' => 'Ставропольский край',
        '27' => 'Хабаровский край',
        '28' => 'Амурская область',
        '29' => 'Архангельская область',
        '30' => 'Астраханская область',
        '31' => 'Белгородская область',
        '32' => 'Брянская область',
        '33' => 'Владимирская область',
        '37' => 'Ивановская область',
        '40' => 'Калужская область',
        '41' => 'Камчатский край',
        '43' => 'Кировская область',
        '44' => 'Костромская область',
        '45' => 'Курганская область',
        '46' => 'Курская область',
        '47' => 'Ленинградская область',
        '48' => 'Липецкая область',
        '49' => 'Магаданская область',
        '51' => 'Мурманская область',
        '53' => 'Новгородская область',
        '55' => 'Омская область',
        '56' => 'Оренбургская область',
        '57' => 'Орловская область',
        '58' => 'Пензенская область',
        '60' => 'Псковская область',
        '62' => 'Рязанская область',
        '65' => 'Сахалинская область',
        '67' => 'Смоленская область',
        '68' => 'Тамбовская область',
        '69' => 'Тверская область',
        '70' => 'Томская область',
        '71' => 'Тульская область',
        '72' => 'Тюменская область',
        '76' => 'Ярославская область',
        '79' => 'Еврейская автономная область',
        '80' => 'Забайкальский край',
        '82' => 'Республика Крым',
        '83' => 'Ненецкий автономный округ',
        '87' => 'Чукотский автономный округ',
        '89' => 'Ямало-Ненецкий автономный округ',
        '91' => 'Калининградская область',
        '92' => 'Севастополь',
        '94' => 'Байконур',
        '95' => 'Чеченская республика',
        '101' => 'Республика Адыгея',
        '102' => 'Республика Башкортостан',
        '103' => 'Республика Бурятия',
        '109' => 'Карачаево-Черкесская Республика',
        '113' => 'Республика Мордовия',
        '116' => 'Республика Татарстан',
        '118' => 'Удмуртская Республика',
        '121' => 'Чувашская Республика',
        '123' => 'Краснодарский край',
        '124' => 'Красноярский край',
        '125' => 'Приморский край',
        '134' => 'Волгоградская область',
        '136' => 'Воронежская область',
        '138' => 'Иркутская область',
        '142' => 'Кемеровская область',
        '152' => 'Нижегородская область',
        '154' => 'Новосибирская область',
        '159' => 'Пермский край',
        '161' => 'Ростовская область',
        '163' => 'Самарская область',
        '164' => 'Саратовская область',
        '173' => 'Ульяновская область',
        '174' => 'Челябинская область',
        '178' => 'Санкт-Петербург',
        '186' => 'Ханты-Мансийский автономный округ',
        '196' => 'Свердловская область',
        '750' => 'Московская область',
        '777' => 'Москва',
    ];

    public function up()
    {
        foreach($this->values as $key => $value) {
            $this->insert($this->table_name, [
                'id' => $key,
                'text' => $value
            ]);
        }
    }

    public function down()
    {
        $this->truncateTable($this->table_name);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
