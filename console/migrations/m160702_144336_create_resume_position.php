<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_position`.
 */
class m160702_144336_create_resume_position extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_position', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-resume_position-resume_id',
            'resume_position',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_position-resume_id',
            'resume_position',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_position-position_id',
            'resume_position',
            'position_id'
        );

        $this->addForeignKey(
            'fk-resume_position-position_id',
            'resume_position',
            'position_id',
            'vacancy_position',
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
            'fk-resume_position-resume_id',
            'resume_position'
        );

        $this->dropIndex(
            'idx-resume_position-resume_id',
            'resume_position'
        );

        $this->dropForeignKey(
            'fk-resume_position-position_id',
            'resume_position'
        );

        $this->dropIndex(
            'idx-resume_position-position_id',
            'resume_position'
        );

        $this->dropTable('resume_position');
    }
}
