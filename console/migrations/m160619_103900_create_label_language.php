<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_language`.
 */
class m160619_103900_create_label_language extends Migration
{

    private $table_name = 'label_language';

    private $default = [
        'Абазинский',
        'Абхазский',
        'Азербайджанский',
        'Албанский',
        'Английский',
        'Арабский',
        'Армянский',
        'Африкаанс',
        'Башкирский',
        'Белорусский',
        'Болгарский',
        'Венгерский',
        'Вьетнамский',
        'Голландский',
        'Греческий',
        'Грузинский',
        'Датский',
        'Иврит',
        'Ингушский',
        'Индонезийский',
        'Испанский',
        'Итальянский',
        'Кабардино-черкесский',
        'Казахский',
        'Карачаево-балкарский',
        'Каталанский',
        'Кашмирский',
        'Китайский',
        'Коми',
        'Корейский',
        'Креольский (Сейшельские острова)',
        'Кумыкский',
        'Курдский',
        'Кхмерский (Камбоджийский)',
        'Кыргызский',
        'Латинский',
        'Латышский',
        'Литовский',
        'Македонский',
        'Малазийский',
        'Молдавский',
        'Монгольский',
        'Немецкий',
        'Ногайский',
        'Норвежский',
        'Осетинский',
        'Персидский',
        'Польский',
        'Португальский',
        'Румынский',
        'Русский',
        'Санскрит',
        'Сербский',
        'Словацкий',
        'Словенский',
        'Суахили',
        'Таджикский',
        'Тайский',
        'Тамильский',
        'Татарский',
        'Турецкий',
        'Туркменский',
        'Узбекский',
        'Уйгурский',
        'Украинский',
        'Урду',
        'Финский',
        'Французский',
        'Хинди',
        'Хорватский',
        'Чеченский',
        'Чешский',
        'Чувашский',
        'Шведский',
        'Эсперанто',
        'Эстонский',
        'Японский'
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'text' => $this->string(255)->notNull()->unique(),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
        ]);

        $this->alterColumn($this->table_name, 'id', $this->smallInteger(1) . ' AUTO_INCREMENT');

        foreach($this->default as $value) {
            $this->insert($this->table_name, [
                'text' => $value
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->table_name);
    }
}
