<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_diploma`.
 */
class m160701_211232_create_label_diploma extends Migration
{
    private $table_name = 'label_diploma';

    private $default = [
        'средняя 2',
        'средняя 3',
        'средняя 4',
        'средняя 5',
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
