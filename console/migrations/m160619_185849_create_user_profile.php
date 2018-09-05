<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_profile`.
 */
class m160619_185849_create_user_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_profile', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'family' => $this->string(32),
            'sex_id' => $this->smallInteger(1),
            'birthday_stamp' => $this->integer(),
            'region_id' => $this->integer(),
            'city_id' => $this->integer(),
            'facebookcom' => $this->string(),
            'youtubecom' => $this->string(),
            'twittercom' => $this->string(),
            'vkcom' => $this->string(),
            'okru' => $this->string(),
            'skype' => $this->string(),
            'email' => $this->string(64),
            'photo' => $this->string(),
        ]);

        $this->createIndex(
            'idx-user_profile-id',
            'user_profile',
            'sex_id'
        );

        $this->addForeignKey(
            'fk-user_profile-id',
            'user_profile',
            'id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_profile-sex_id',
            'user_profile',
            'sex_id'
        );

        $this->addForeignKey(
            'fk-user_profile-sex_id',
            'user_profile',
            'sex_id',
            'label_sex',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_profile-region_id',
            'user_profile',
            'region_id'
        );

        $this->addForeignKey(
            'fk-user_profile-region_id',
            'user_profile',
            'region_id',
            'location_region',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_profile-city_id',
            'user_profile',
            'city_id'
        );

        $this->addForeignKey(
            'fk-user_profile-city_id',
            'user_profile',
            'city_id',
            'location_city',
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
            'fk-user_profile-id',
            'user_profile'
        );

        $this->dropIndex(
            'idx-user_profile-id',
            'user_profile'
        );


        $this->dropForeignKey(
            'fk-user_profile-sex_id',
            'user_profile'
        );

        $this->dropIndex(
            'idx-user_profile-sex_id',
            'user_profile'
        );

        $this->dropForeignKey(
            'fk-user_profile-region_id',
            'user_profile'
        );

        $this->dropIndex(
            'idx-user_profile-region_id',
            'user_profile'
        );

        $this->dropForeignKey(
            'fk-user_profile-city_id',
            'user_profile'
        );

        $this->dropIndex(
            'idx-user_profile-city_id',
            'user_profile'
        );

        $this->dropTable('user_profile');
    }
}
