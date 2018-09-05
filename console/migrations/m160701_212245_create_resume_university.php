<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_university`.
 */
class m160701_212245_create_resume_university extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_university', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'title_id' => $this->integer()->notNull(),
            'faculty_id' => $this->integer()->notNull(),
            'specialty_id' => $this->integer()->notNull(),
            'level_id' => $this->smallInteger()->notNull(),
            'diploma_id' => $this->smallInteger()->notNull(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_university-resume_id',
            'resume_university',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_university-resume_id',
            'resume_university',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_university-title_id',
            'resume_university',
            'title_id'
        );

        $this->addForeignKey(
            'fk-resume_university-title_id',
            'resume_university',
            'title_id',
            'company_place',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_university-faculty_id',
            'resume_university',
            'faculty_id'
        );

        $this->addForeignKey(
            'fk-resume_university-faculty_id',
            'resume_university',
            'faculty_id',
            'label_faculty',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_university-specialty_id',
            'resume_university',
            'specialty_id'
        );

        $this->addForeignKey(
            'fk-resume_university-specialty_id',
            'resume_university',
            'specialty_id',
            'vacancy_position',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_university-level_id',
            'resume_university',
            'level_id'
        );

        $this->addForeignKey(
            'fk-resume_university-level_id',
            'resume_university',
            'level_id',
            'label_level',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_university-diploma_id',
            'resume_university',
            'diploma_id'
        );

        $this->addForeignKey(
            'fk-resume_university-diploma_id',
            'resume_university',
            'diploma_id',
            'label_diploma',
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
            'fk-resume_university-resume_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-resume_id',
            'resume_university'
        );

        $this->dropForeignKey(
            'fk-resume_university-title_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-title_id',
            'resume_university'
        );

        $this->dropForeignKey(
            'fk-resume_university-faculty_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-faculty_id',
            'resume_university'
        );

        $this->dropForeignKey(
            'fk-resume_university-specialty_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-specialty_id',
            'resume_university'
        );

        $this->dropForeignKey(
            'fk-resume_university-level_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-level_id',
            'resume_university'
        );

        $this->dropForeignKey(
            'fk-resume_university-diploma_id',
            'resume_university'
        );

        $this->dropIndex(
            'idx-resume_university-diploma_id',
            'resume_university'
        );

        $this->dropTable('resume_university');
    }
}
