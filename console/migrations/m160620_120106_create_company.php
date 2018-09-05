<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company`.
 */
class m160620_120106_create_company extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'phone' => $this->string(10),
            'site' => $this->string(255),
            'email' => $this->string(),
            'scope_id' => $this->smallInteger(1)->notNull(),
            'logotype' => $this->string(),
            'status_id' => $this->integer()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-company_count-id',
            'company_count',
            'id'
        );

        $this->addForeignKey(
            'fk-company_count-id',
            'company_count',
            'id',
            'company',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-company-user_id',
            'company',
            'user_id'
        );

        $this->addForeignKey(
            'fk-company-user_id',
            'company',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-company-title_id',
            'company',
            'title_id'
        );

        $this->addForeignKey(
            'fk-company-title_id',
            'company',
            'title_id',
            'company_place',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-company-scope_id',
            'company',
            'scope_id'
        );

        $this->addForeignKey(
            'fk-company-scope_id',
            'company',
            'scope_id',
            'label_scope',
            'id',
            'CASCADE'
        );

        $this->insert('company', [
            'user_id' => '1',
            'title_id' => '1',
            'content' => '',
            'scope_id' => '1',
            'status_id' => '0',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('company_count', [
            'id' => '1',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-company_count-id',
            'company_count'
        );

        $this->dropIndex(
            'idx-company_count-id',
            'company_count'
        );

        $this->dropForeignKey(
            'fk-company-user_id',
            'company'
        );

        $this->dropIndex(
            'idx-company-user_id',
            'company'
        );

        $this->dropForeignKey(
            'fk-company-title_id',
            'company'
        );

        $this->dropIndex(
            'idx-company-title_id',
            'company'
        );

        $this->dropForeignKey(
            'fk-company-scope_id',
            'company'
        );

        $this->dropIndex(
            'idx-company-scope_id',
            'company'
        );

        $this->truncateTable('company_count');

        $this->dropTable('company');
    }
}
