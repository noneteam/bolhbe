<?php

use yii\db\Migration;

class m160619_144539_update_user extends Migration
{
	public function up()
	{
		// Добавлю в название поля _id
		$this->renameColumn('user', 'status', 'status_id');

		// Поле email переносится в таблицу user_profile
		$this->dropColumn('user', 'email');

		// Заменяю имя пользователя на телефон
		$this->dropColumn('user', 'username');
		$this->addColumn('user', 'phone', $this->string(10)->notNull() . ' AFTER `id`');

		// Поля для перехода на новый тип шифорвания (временная мера)
		$this->addColumn('user', 'password_md5', $this->string(32) . ' AFTER `auth_key`');

		$this->addColumn('user', 'show_phone_id', $this->smallInteger(1)->notNull()->defaultValue(3) . ' AFTER `password_reset_token`');

		$this->createIndex(
			'idx-user-show_phone_id',
			'user',
			'show_phone_id'
		);

		$this->addForeignKey(
			'fk-user-show_phone_id',
			'user',
			'show_phone_id',
			'label_show_phone',
			'id',
			'CASCADE'
		);

	}

	public function down()
	{
		$this->dropForeignKey(
			'fk-user-show_phone_id',
			'user'
		);

		$this->dropIndex(
			'idx-user-show_phone_id',
			'user'
		);

		$this->renameColumn('user', 'status_id', 'status');

		$this->addColumn('user', 'email', $this->string()->notNull()->unique() . ' AFTER `password_reset_token`');

		$this->dropColumn('user', 'phone');
		$this->addColumn('user', 'username', $this->string()->notNull()->unique() . ' AFTER `id`');

		$this->dropColumn('user', 'password_md5');

		$this->dropColumn('user', 'show_phone_id');
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
