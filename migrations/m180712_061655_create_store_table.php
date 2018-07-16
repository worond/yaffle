<?php

use yii\db\Migration;

/**
 * Handles the creation of table `store`.
 */
class m180712_061655_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->text(),
            'coordinates' => $this->string(),
            'external_link' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer()->unsigned()
        ]);

        $this->createIndex('idx-store-code', '{{%store}}', 'code');
        $this->createIndex('idx-store-active', '{{%store}}', 'active');

        $this->createIndex('idx-store-city_id', '{{%store}}', 'city_id');
        $this->addForeignKey('fk-store-city_id', '{{%store}}', 'city_id', '{{%city}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
