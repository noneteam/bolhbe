<?php

use yii\db\Migration;

/**
 * Handles the creation for table `vacancy_position`.
 */
class m160623_203543_create_vacancy_position extends Migration
{
    private $table_name = 'vacancy_position';

    private $default = [
        'Любая должность'
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'text' => $this->string(64)->notNull()->unique(),
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
