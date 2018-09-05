<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_experience`.
 */
class m160619_103845_create_label_experience extends Migration
{
    private $table_name = 'label_experience';

    private $default = [
        'Без опыта',
        '1-3 года',
        '3-6 лет',
        'Более 6 лет'
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
