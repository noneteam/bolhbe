<?php

use yii\db\Migration;

/**
 * Handles the creation for table `resume_experience`.
 */
class m160702_083421_create_resume_experience extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resume_experience', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'place_id' => $this->integer()->notNull(),
            'region_id' => $this->integer()->notNull(),
            'scope_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'site' => $this->string(255),
            'hired_at' => $this->integer()->notNull(),
            'dismissed_at' => $this->integer(),
            'content' => $this->text()->notNull(),
            'status_id' => $this->integer()->notNull()->defaultValue(10),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resume_experience-resume_id',
            'resume_experience',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-resume_experience-resume_id',
            'resume_experience',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_experience-position_id',
            'resume_experience',
            'position_id'
        );

        $this->addForeignKey(
            'fk-resume_experience-position_id',
            'resume_experience',
            'position_id',
            'vacancy_position',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_experience-place_id',
            'resume_experience',
            'place_id'
        );

        $this->addForeignKey(
            'fk-resume_experience-place_id',
            'resume_experience',
            'place_id',
            'company_place',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_experience-region_id',
            'resume_experience',
            'region_id'
        );

        $this->addForeignKey(
            'fk-resume_experience-region_id',
            'resume_experience',
            'region_id',
            'location_region',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-resume_experience-scope_id',
            'resume_experience',
            'scope_id'
        );

        $this->addForeignKey(
            'fk-resume_experience-scope_id',
            'resume_experience',
            'scope_id',
            'label_scope',
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
            'fk-resume_experience-resume_id',
            'resume_experience'
        );

        $this->dropIndex(
            'idx-resume_experience-resume_id',
            'resume_experience'
        );

        $this->dropForeignKey(
            'fk-resume_experience-position_id',
            'resume_experience'
        );

        $this->dropIndex(
            'idx-resume_experience-position_id',
            'resume_experience'
        );

        $this->dropForeignKey(
            'fk-resume_experience-place_id',
            'resume_experience'
        );

        $this->dropIndex(
            'idx-resume_experience-place_id',
            'resume_experience'
        );

        $this->dropForeignKey(
            'fk-resume_experience-region_id',
            'resume_experience'
        );

        $this->dropIndex(
            'idx-resume_experience-region_id',
            'resume_experience'
        );

        $this->dropForeignKey(
            'fk-resume_experience-scope_id',
            'resume_experience'
        );

        $this->dropIndex(
            'idx-resume_experience-scope_id',
            'resume_experience'
        );

        $this->dropTable('resume_experience');
    }
}
