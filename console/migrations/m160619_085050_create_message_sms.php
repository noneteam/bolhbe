<?php

use yii\db\Migration;

/**
 * Handles the creation for table `message_sms`.
 */
class m160619_085050_create_message_sms extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('message_sms', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(10)->notNull(),
            'text' => $this->string(70)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('message_sms');
    }
}
