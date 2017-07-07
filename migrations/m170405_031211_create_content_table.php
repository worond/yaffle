<?php

use yii\db\Migration;

/**
 * Handles the creation of table `content`.
 */
class m170405_031211_create_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%content_type}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer(),
            'created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-content_type-name', '{{%content_type}}', 'name');
        $this->createIndex('idx-content_type-code', '{{%content_type}}', 'code');
        $this->createIndex('idx-content_type-active', '{{%content_type}}', 'active');

        $this->createTable('{{%content_field}}', [
            'id' => $this->primaryKey(),
            'content_type_id' => $this->integer()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(1),
            'grid' => $this->boolean()->defaultValue(1),
        ]);

        $this->createIndex('idx-content_field-content_type_id', '{{%content_field}}', 'content_type_id');
        $this->createIndex('idx-content_field-code', '{{%content_field}}', 'code');
        $this->createIndex('idx-content_field-name', '{{%content_field}}', 'name');
        $this->createIndex('idx-content_field-active', '{{%content_field}}', 'active');
        $this->addForeignKey('fk-content_field-content_type', '{{%content_field}}', 'content_type_id', '{{%content_type}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%content}}', [
            'id' => $this->primaryKey(),
            'content_type_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer(),
            'created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-content-content_type_id', '{{%content}}', 'content_type_id');
        $this->createIndex('idx-content-active', '{{%content}}', 'active');
        $this->addForeignKey('fk-content-content_type', '{{%content}}', 'content_type_id', '{{%content_type}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%content_value}}', [
            'content_id' => $this->integer()->notNull(),
            'field_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        $this->addPrimaryKey('pk-content_value', '{{%content_value}}', ['content_id', 'field_id']);
        $this->createIndex('idx-content_value-content_id', '{{%content_value}}', 'content_id');
        $this->createIndex('idx-content_value-field_id', '{{%content_value}}', 'field_id');
        $this->createIndex('idx-content_value-value', '{{%content_value}}', 'value');
        $this->addForeignKey('fk-content_value-content', '{{%content_value}}', 'content_id', '{{%content}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-content_value-field', '{{%content_value}}', 'field_id', '{{%content_field}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%content_value}}');
        $this->dropTable('{{%content_field}}');
        $this->dropTable('{{%content}}');
        $this->dropTable('{{%content_type}}');
    }
}
