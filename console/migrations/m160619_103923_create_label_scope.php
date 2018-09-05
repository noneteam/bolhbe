<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_scope`.
 */
class m160619_103923_create_label_scope extends Migration
{
    private $table_name = 'label_scope';

    private $default = [
        'Продажи',
        'Обслуживающий персонал, секретариат, АХО',
        'Строительство, благоустройство',
        'Промышленность, производство',
        'Бухгалтерия, аудит',
        'IT, телекоммуникации, связь, электроника',
        'Транспорт, авиа- , ж/д, речной',
        'Логистика, таможня, склад',
        'Прототипирование, разработка ПО',
        'Маркетинг, реклама, PR',
        'Банки, инвестиции, лизинг',
        'Автосервис, автобизнес',
        'Экономика, финансы',
        'Рестораны, фастфуд',
        'Работа для студентов, начало карьеры',
        'Юриспруденция',
        'Туризм, гостиничное дело',
        'Государственная служба, некоммерческие организации',
        'Красота, фитнес, спорт',
        'Образование, наука',
        'Топ-менеджмент',
        'Медицина, фармацевтика',
        'Охрана, безопасность, полиция',
        'Искусство, культура',
        'Интернет',
        'Рынок труда',
        'СМИ, массмедиа',
        'Дизайн',
        'Нефть, газ, энергетика',
        'Персонал для дома',
        'Удаленная работа',
        'Игорный, модельный и шоу-бизнес',
        'Недвижимость, риэлтерство',
        'Страхование',
        'Консалтинг, стратегическое развитие',
        'Оборонная промышленность',
        'Муниципалитет',
        'Сельское хозяйство',
        'Другое'
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'text' => $this->string(255)->notNull()->unique(),
            'type_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
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
