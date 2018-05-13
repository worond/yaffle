<?php

use yii\db\Migration;

/**
 * Handles the creation of table `region`.
 */
class m180412_052513_create_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->text(),
            'coordinates' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer()->unsigned()
        ]);

        $this->createIndex('idx-region-code', '{{%region}}', 'code');
        $this->createIndex('idx-region-active', '{{%region}}', 'active');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%region}}');
    }
}
