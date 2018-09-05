<?php

use yii\db\Migration;

/**
 * Handles the creation for table `label_faculty`.
 */
class m160701_210436_create_label_faculty extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('label_faculty', [
            'id' => $this->primaryKey(),
            'text' => $this->string(64)->notNull()->unique(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('label_faculty');
    }
}
