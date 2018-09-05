<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume`.
 */
class m160622_105011_create_resume extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'salary' => $this->bigInteger(),
            'employment_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'move_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'trip_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'time_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'scope_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'state_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'status_id' => $this->smallInteger(1)->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume-user_id',
            'resume',
            'user_id'
        );

        $this->addForeignKey(
            'fk-resume-user_id',
            'resume',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-employment_id',
            'resume',
            'employment_id'
        );

        $this->addForeignKey(
            'fk-resume-employment_id',
            'resume',
            'employment_id',
            'label_employment',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-move_id',
            'resume',
            'move_id'
        );

        $this->addForeignKey(
            'fk-resume-move_id',
            'resume',
            'move_id',
            'label_move',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-trip_id',
            'resume',
            'trip_id'
        );

        $this->addForeignKey(
            'fk-resume-trip_id',
            'resume',
            'trip_id',
            'label_trip',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-time_id',
            'resume',
            'time_id'
        );

        $this->addForeignKey(
            'fk-resume-time_id',
            'resume',
            'time_id',
            'label_time',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-scope_id',
            'resume',
            'scope_id'
        );

        $this->addForeignKey(
            'fk-resume-scope_id',
            'resume',
            'scope_id',
            'label_scope',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume-state_id',
            'resume',
            'state_id'
        );

        $this->addForeignKey(
            'fk-resume-state_id',
            'resume',
            'state_id',
            'label_state',
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
            'fk-resume-user_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-user_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-employment_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-employment_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-move_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-move_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-trip_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-trip_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-time_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-time_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-scope_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-scope_id',
            'resume'
        );

        $this->dropForeignKey(
            'fk-resume-state_id',
            'resume'
        );

        $this->dropIndex(
            'idx-resume-state_id',
            'resume'
        );

        $this->dropTable('resume');
    }
}
