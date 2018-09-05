<?php

use yii\db\Migration;

/**
 * Handles the creation for table `vacancy`.
 */
class m160623_204918_create_vacancy extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vacancy', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->defaultValue(1),
            'company_place_id' => $this->integer(),
            'position_id' => $this->integer()->notNull()->defaultValue(1),
            'salary' => $this->bigInteger(),
            'experience_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'employment_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'scope_id' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'content' => $this->text()->notNull(),
            'region_id' => $this->integer(),
            'city_id' => $this->integer(),
            'phone' => $this->string(10),

            'status_id' => $this->integer()->notNull()->defaultValue(10),
            'expire_at' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-vacancy-user_id',
            'vacancy',
            'user_id'
        );

        $this->addForeignKey(
            'fk-vacancy-user_id',
            'vacancy',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-company_place_id',
            'vacancy',
            'company_place_id'
        );

        $this->addForeignKey(
            'fk-vacancy-company_place_id',
            'vacancy',
            'company_place_id',
            'company_place',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-position_id',
            'vacancy',
            'position_id'
        );

        $this->addForeignKey(
            'fk-vacancy-position_id',
            'vacancy',
            'position_id',
            'vacancy_position',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-experience_id',
            'vacancy',
            'experience_id'
        );

        $this->addForeignKey(
            'fk-vacancy-experience_id',
            'vacancy',
            'experience_id',
            'label_experience',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-employment_id',
            'vacancy',
            'employment_id'
        );

        $this->addForeignKey(
            'fk-vacancy-employment_id',
            'vacancy',
            'employment_id',
            'label_employment',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-scope_id',
            'vacancy',
            'scope_id'
        );

        $this->addForeignKey(
            'fk-vacancy-scope_id',
            'vacancy',
            'scope_id',
            'label_scope',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-region_id',
            'vacancy',
            'region_id'
        );

        $this->addForeignKey(
            'fk-vacancy-region_id',
            'vacancy',
            'region_id',
            'location_region',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-vacancy-city_id',
            'vacancy',
            'city_id'
        );

        $this->addForeignKey(
            'fk-vacancy-city_id',
            'vacancy',
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
            'fk-vacancy-user_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-user_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-company_place_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-company_place_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-position_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-position_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-experience_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-experience_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-employment_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-employment_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-scope_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-scope_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-region_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-region_id',
            'vacancy'
        );

        $this->dropForeignKey(
            'fk-vacancy-city_id',
            'vacancy'
        );

        $this->dropIndex(
            'idx-vacancy-city_id',
            'vacancy'
        );

        $this->dropTable('vacancy');
    }
}
