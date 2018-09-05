<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_count`.
 */
class m160622_105020_create_resume_count extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_count', [
            'id' => $this->primaryKey(),
            'view' => $this->integer()->notNull()->defaultValue(0),
            'experience' => $this->integer()->notNull()->defaultValue(0),
            'university' => $this->integer()->notNull()->defaultValue(0),
            'course' => $this->integer()->notNull()->defaultValue(0),
            'test' => $this->integer()->notNull()->defaultValue(0),
            'language' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-resume_count-id',
            'resume_count',
            'id'
        );

        $this->addForeignKey(
            'fk-resume_count-id',
            'resume_count',
            'id',
            'resume',
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
            'fk-resume_count-id',
            'resume_count'
        );

        $this->dropIndex(
            'idx-resume_count-id',
            'resume_count'
        );

        $this->dropTable('resume_count');
    }
}
