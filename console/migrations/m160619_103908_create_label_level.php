<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_level`.
 */
class m160619_103908_create_label_level extends Migration
{
    private $table_name = 'label_level';

    private $defaultLanguage = [
        'Базовые знания',
        'Читаю профессиональную литературу',
        'Могу проходить интервью',
        'Cвободно владею'
    ];
    private $defaultStudy = [
        'Среднее специальное',
        'Бакалавр',
        'Неоконченное высшее',
        'Высшее',
        'Магистр',
        'Кандидат наук',
        'Доктор наук'
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'text' => $this->string(255)->notNull(),
            'type_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
        ]);

        $this->alterColumn($this->table_name, 'id', $this->smallInteger(1) . ' AUTO_INCREMENT');

        foreach($this->defaultLanguage as $value) {
            $this->insert($this->table_name, [
                'text' => $value
            ]);
        }

        foreach($this->defaultStudy as $value) {
            $this->insert($this->table_name, [
                'text' => $value,
                'type_id' => '2'
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
