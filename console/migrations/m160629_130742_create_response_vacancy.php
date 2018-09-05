<?php

use yii\db\Migration;

/**
 * Handles the creation for table `response_vacancy`.
 */
class m160629_130742_create_response_vacancy extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('response_vacancy', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'resume_id' => $this->integer()->notNull(),
            'vacancy_id' => $this->integer()->notNull(),
            'show_phone_id' => $this->smallInteger()->notNull()->defaultValue(10),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(5),

            'created_at' => $this->integer()->notNull(),
            'received_at' => $this->integer(),
            'responded_at' => $this->integer(),
            'received_back_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-response_vacancy-user_id',
            'response_vacancy',
            'user_id'
        );

        $this->addForeignKey(
            'fk-response_vacancy-user_id',
            'response_vacancy',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-response_vacancy-resume_id',
            'response_vacancy',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-response_vacancy-resume_id',
            'response_vacancy',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-response_vacancy-vacancy_id',
            'response_vacancy',
            'vacancy_id'
        );

        $this->addForeignKey(
            'fk-response_vacancy-vacancy_id',
            'response_vacancy',
            'vacancy_id',
            'vacancy',
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
            'fk-response_vacancy-user_id',
            'response_vacancy'
        );

        $this->dropIndex(
            'idx-response_vacancy-user_id',
            'response_vacancy'
        );

        $this->dropForeignKey(
            'fk-response_vacancy-resume_id',
            'response_vacancy'
        );

        $this->dropIndex(
            'idx-response_vacancy-resume_id',
            'response_vacancy'
        );

        $this->dropForeignKey(
            'fk-response_vacancy-vacancy_id',
            'response_vacancy'
        );

        $this->dropIndex(
            'idx-response_vacancy-vacancy_id',
            'response_vacancy'
        );

        $this->dropTable('response_vacancy');
    }
}
