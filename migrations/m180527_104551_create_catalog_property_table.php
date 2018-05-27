<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog_property`.
 */
class m180527_104551_create_catalog_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_property_type}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'on_filter' => $this->boolean()->defaultValue(0),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-catalog_property_type-code', '{{%catalog_property_type}}', 'code');
        $this->createIndex('idx-catalog_property_type-on_filter', '{{%catalog_property_type}}', 'on_filter');
        $this->createIndex('idx-catalog_property_type-active', '{{%catalog_property_type}}', 'active');

        $this->createTable('{{%catalog_property_value}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
            'on_filter' => $this->boolean()->defaultValue(0),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-catalog_property_value-type_id', '{{%catalog_property_value}}', 'type_id');
        $this->createIndex('idx-catalog_property_value-value', '{{%catalog_property_value}}', 'value');
        $this->createIndex('idx-catalog_property_value-on_filter', '{{%catalog_property_value}}', 'on_filter');
        $this->createIndex('idx-catalog_property_value-active', '{{%catalog_property_value}}', 'active');
        $this->addForeignKey('fk-catalog_property_value-type_id', '{{%catalog_property_value}}', 'type_id', '{{%catalog_property_type}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%catalog_property}}', [
            'id' => $this->primaryKey(),
            'catalog_id' => $this->integer()->notNull(),
            'value_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-catalog_property-catalog_id', '{{%catalog_property}}', 'catalog_id');
        $this->createIndex('idx-catalog_property-value_id', '{{%catalog_property}}', 'value_id');
        $this->addForeignKey('fk-catalog_property-catalog_id', '{{%catalog_property}}', 'catalog_id', '{{%catalog}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-catalog_property-value_id', '{{%catalog_property}}', 'value_id', '{{%catalog_property_value}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catalog_property}}');
        $this->dropTable('{{%catalog_property_value}}');
        $this->dropTable('{{%catalog_property_type}}');
    }
}
