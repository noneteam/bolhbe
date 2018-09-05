<?php

use yii\db\Migration;

class m160619_190342_dump_to_user_and_profile extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'phone' => '',
            'auth_key' => '',
            'password_hash' => '',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('user_profile', [
            'id' => '1',
            'name' => 'Гость'
        ]);
    }

    public function down()
    {
        $this->truncateTable('user_profile');

        $this->dropForeignKey(
            'fk-user_profile-id',
            'user_profile'
        );

        $this->truncateTable('user');

        $this->addForeignKey(
            'fk-user_profile-id',
            'user_profile',
            'id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
