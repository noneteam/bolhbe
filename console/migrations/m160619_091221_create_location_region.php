<?php

use yii\db\Migration;

/**
 * Handles the creation for table `location_region`.
 */
class m160619_091221_create_location_region extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('location_region', [
            'id' => $this->primaryKey(),
            'text' => $this->string(64)->notNull()->unique(),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('location_region');
    }
}
