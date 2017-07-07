<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170705_092627_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%service_category}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-service_category-code', '{{%service_category}}', 'code');
        $this->createIndex('idx-service_category-active', '{{%service_category}}', 'active');

        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'image_id' => $this->integer(),
            'icon_id' => $this->integer(),
            'thumbnail_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'title_menu' => $this->string(),
            'title' => $this->string(),
            'annotation' => $this->text(),
            'description' => $this->text(),
            'external_link' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'created' => $this->timestamp()->notNull(),
        ]);

        $this->createIndex('idx-service-category_id', '{{%service}}', 'category_id');
        $this->createIndex('idx-service-image_id', '{{%service}}', 'image_id');
        $this->createIndex('idx-service-icon_id', '{{%service}}', 'icon_id');
        $this->createIndex('idx-service-thumbnail_id', '{{%service}}', 'thumbnail_id');
        $this->createIndex('idx-service-seo_id', '{{%service}}', 'seo_id');
        $this->createIndex('idx-service-code', '{{%service}}', 'code');
        $this->createIndex('idx-service-active', '{{%service}}', 'active');
        $this->addForeignKey('fk-service-category', '{{%service}}', 'category_id', '{{%service_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-service-image', '{{%service}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-service-icon', '{{%service}}', 'icon_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-service-thumbnail', '{{%service}}', 'thumbnail_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-service-seo', '{{%service}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%service_image}}', [
            'service_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-service_image', '{{%service_image}}', ['service_id', 'file_id']);

        $this->createIndex('idx-service_image-service_id', '{{%service_image}}', 'service_id');
        $this->createIndex('idx-service_image-file_id', '{{%service_image}}', 'file_id');

        $this->addForeignKey('fk-service_image-service_id', '{{%service_image}}', 'service_id', '{{%service}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-service_image-file_id', '{{%service_image}}', 'file_id', '{{%file}}', 'id', 'CASCADE', 'RESTRICT');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%service_image}}');
        $this->dropTable('{{%service}}');
        $this->dropTable('{{%service_category}}');
    }
}
