<?php

use yii\db\Migration;

class m160918_121308_update_user_for_facebook extends Migration
{
	public function up()
	{
		$this->alterColumn('user','phone', $this->string(10));

		$this->addColumn('user', 'facebook_hash', $this->string(255) . ' AFTER `password_hash`');
	}

	public function down()
	{
		$this->dropColumn('user', 'facebook_hash');
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
