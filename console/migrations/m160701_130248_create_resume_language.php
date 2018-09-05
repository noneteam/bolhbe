<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_language`.
 */
class m160701_130248_create_resume_language extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_language', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'language_id' => $this->smallInteger()->notNull(),
            'level_id' => $this->smallInteger()->notNull(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_language-resume_id',
            'resume_language',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_language-resume_id',
            'resume_language',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_language-language_id',
            'resume_language',
            'language_id'
        );

        $this->addForeignKey(
            'fk-resume_language-language_id',
            'resume_language',
            'language_id',
            'label_language',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_language-level_id',
            'resume_language',
            'level_id'
        );

        $this->addForeignKey(
            'fk-resume_language-level_id',
            'resume_language',
            'level_id',
            'label_level',
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
            'fk-resume_language-resume_id',
            'resume_language'
        );

        $this->dropIndex(
            'idx-resume_language-resume_id',
            'resume_language'
        );

        $this->dropForeignKey(
            'fk-resume_language-language_id',
            'resume_language'
        );

        $this->dropIndex(
            'idx-resume_language-language_id',
            'resume_language'
        );

        $this->dropForeignKey(
            'fk-resume_language-level_id',
            'resume_language'
        );

        $this->dropIndex(
            'idx-resume_language-level_id',
            'resume_language'
        );

        $this->dropTable('resume_language');
    }
}
