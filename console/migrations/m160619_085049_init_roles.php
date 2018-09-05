<?php

use yii\db\Migration;

class m160619_085049_init_roles extends Migration
{
	public function up()
	{
		$roles = [
			[
				'name' => 'banned',
				'description' => 'Забаненный пользователь'
			], [
				'name' => 'noauthentic',
				'description' => 'Пользователь с не проверенным телефоном (роль уходит в историю)'
			], [
				'name' => 'authentic',
				'description' => 'Пользователь с проверенным телефоном (роль уходит в историю)'
			], [
				'name' => 'facebookUser',
				'description' => 'Чистый facebook пользователь.'
			], [
				'name' => 'user',
				'description' => 'Пользователь с профилем'
			], [
				'name' => 'worker',
				'description' => 'Пользователь с резюме'
			], [
				'name' => 'employer',
				'description' => 'Пользоваетель с компанией'
			], [
				'name' => 'manager',
				'description' => 'Модератор'
			], [
				'name' => 'admin',
				'description' => 'Администратор'
			],
		];

		foreach ($roles as $role) {
			$this->insert('auth_item', [
				'name' => $role['name'],
				'description' => $role['description'],
				'type' => '1',
				'created_at' => time(),
				'updated_at' => time(),
			]);
		}
	}

	public function down()
	{
		echo "Нечего выполнять.\n";
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
