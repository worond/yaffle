<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m180412_052528_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->text(),
            'coordinates' => $this->string(),
            'external_link' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer()->unsigned()
        ]);

        $this->createIndex('idx-city-code', '{{%city}}', 'code');
        $this->createIndex('idx-city-active', '{{%city}}', 'active');

        $this->createIndex('idx-city-region_id', '{{%city}}', 'region_id');
        $this->addForeignKey('fk-city-region_id', '{{%city}}', 'region_id', '{{%region}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
