<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_state`.
 */
class m160619_104014_create_label_state extends Migration
{
    private $table_name = 'label_state';

    private $default = [
        'Сейчас свободен',
        'Сейчас занят'
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
