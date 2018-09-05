<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_count`.
 */
class m160620_120011_create_company_count extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_count', [
            'id' => $this->primaryKey(),
            'view' => $this->integer()->notNull()->defaultValue(0),
            'vacancy' => $this->integer()->notNull()->defaultValue(0),
            'project' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_count');
    }
}
