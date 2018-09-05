<?php

use yii\db\Migration;

/**
 * Handles the creation for table `location_city`.
 */
class m160619_094546_create_location_city extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('location_city', [
            'id' => $this->primaryKey(),
            'text' => $this->string(64)->notNull()->unique(),
            'region_id' => $this->integer()->notNull()->defaultValue(1),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
        ]);

        $this->createIndex(
            'idx-location_city-region_id',
            'location_city',
            'region_id'
        );

        $this->addForeignKey(
            'fk-location_city-region_id',
            'location_city',
            'region_id',
            'location_region',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-location_city-region_id',
            'location_city'
        );

        $this->dropIndex(
            'idx-location_city-region_id',
            'location_city'
        );

        $this->dropTable('location_city');
    }
}
