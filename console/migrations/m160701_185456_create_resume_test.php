<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_test`.
 */
class m160701_185456_create_resume_test extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_test', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'text' => $this->string(64)->notNull(),
            'company_place_id' => $this->integer()->notNull(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_test-resume_id',
            'resume_test',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_test-resume_id',
            'resume_test',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_test-company_place_id',
            'resume_test',
            'company_place_id'
        );

        $this->addForeignKey(
            'fk-resume_test-company_place_id',
            'resume_test',
            'company_place_id',
            'company_place',
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
            'fk-resume_test-resume_id',
            'resume_test'
        );

        $this->dropIndex(
            'idx-resume_test-resume_id',
            'resume_test'
        );

        $this->dropForeignKey(
            'fk-resume_test-company_place_id',
            'resume_test'
        );

        $this->dropIndex(
            'idx-resume_test-company_place_id',
            'resume_test'
        );

        $this->dropTable('resume_test');
    }
}
