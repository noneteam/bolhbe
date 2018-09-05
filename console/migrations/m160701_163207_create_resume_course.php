<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_course`.
 */
class m160701_163207_create_resume_course extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_course', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'text' => $this->string(64)->notNull(),
            'company_place_id' => $this->integer()->notNull(),
            'certificate_id' => $this->smallInteger()->notNull(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_course-resume_id',
            'resume_course',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_course-resume_id',
            'resume_course',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_course-company_place_id',
            'resume_course',
            'company_place_id'
        );

        $this->addForeignKey(
            'fk-resume_course-company_place_id',
            'resume_course',
            'company_place_id',
            'company_place',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_course-certificate_id',
            'resume_course',
            'certificate_id'
        );

        $this->addForeignKey(
            'fk-resume_course-certificate_id',
            'resume_course',
            'certificate_id',
            'label_certificate',
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
            'fk-resume_course-resume_id',
            'resume_course'
        );

        $this->dropIndex(
            'idx-resume_course-resume_id',
            'resume_course'
        );

        $this->dropForeignKey(
            'fk-resume_course-company_place_id',
            'resume_course'
        );

        $this->dropIndex(
            'idx-resume_course-company_place_id',
            'resume_course'
        );

        $this->dropForeignKey(
            'fk-resume_course-certificate_id',
            'resume_course'
        );

        $this->dropIndex(
            'idx-resume_course-certificate_id',
            'resume_course'
        );

        $this->dropTable('resume_course');
    }
}
