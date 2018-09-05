<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_place`.
 */
class m160620_115815_create_company_place extends Migration
{
    private $table_name = 'company_place';

    private $default = [
        'Нет названия',
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'text' => $this->string(128)->notNull()->unique(),
            'type_id' => $this->smallInteger(1)->notNull()->defaultValue(3),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
        ]);

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
