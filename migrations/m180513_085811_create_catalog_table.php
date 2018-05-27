<?php

use yii\db\Migration;

/**
 * Handles the creation of table `catalog`.
 */
class m180513_085811_create_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_category}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-catalog_category-code', '{{%catalog_category}}', 'code');
        $this->createIndex('idx-catalog_category-active', '{{%catalog_category}}', 'active');
        $this->createIndex('idx-catalog_category-image_id', '{{%catalog_category}}', 'image_id');
        $this->createIndex('idx-catalog_category-parent_id', '{{%catalog_category}}', 'parent_id');
        $this->createIndex('idx-catalog_category-seo_id', '{{%catalog_category}}', 'seo_id');
        $this->addForeignKey('fk-catalog_category-image', '{{%catalog_category}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-catalog_category-parent', '{{%catalog_category}}', 'parent_id', '{{%catalog_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-catalog_category-seo', '{{%catalog_category}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%catalog}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'image_id' => $this->integer(),
            'type_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'annotation' => $this->text(),
            'description' => $this->text(),
            'article' => $this->string(),
            'grade' => $this->string(),
            'viscosity_grade' => $this->string(),
            'packaging' => $this->string(),
            'price' => $this->decimal(),
            'active' => $this->boolean()->defaultValue(1),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex('idx-catalog-category_id', '{{%catalog}}', 'category_id');
        $this->createIndex('idx-catalog-image_id', '{{%catalog}}', 'image_id');
        $this->createIndex('idx-catalog-type_id', '{{%catalog}}', 'type_id');
        $this->createIndex('idx-catalog-seo_id', '{{%catalog}}', 'seo_id');
        $this->createIndex('idx-catalog-code', '{{%catalog}}', 'code');
        $this->createIndex('idx-catalog-active', '{{%catalog}}', 'active');
        $this->addForeignKey('fk-catalog-category', '{{%catalog}}', 'category_id', '{{%catalog_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-catalog-image', '{{%catalog}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-catalog-type', '{{%catalog}}', 'type_id', '{{%content}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-catalog-seo', '{{%catalog}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%catalog_image}}', [
            'catalog_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-catalog_image', '{{%catalog_image}}', ['catalog_id', 'file_id']);
        $this->createIndex('idx-catalog_image-catalog_id', '{{%catalog_image}}', 'catalog_id');
        $this->createIndex('idx-catalog_image-file_id', '{{%catalog_image}}', 'file_id');
        $this->addForeignKey('fk-catalog_image-catalog_id', '{{%catalog_image}}', 'catalog_id', '{{%catalog}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-catalog_image-file_id', '{{%catalog_image}}', 'file_id', '{{%file}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%catalog_file}}', [
            'catalog_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-catalog_file', '{{%catalog_file}}', ['catalog_id', 'file_id']);
        $this->createIndex('idx-catalog_file-catalog_id', '{{%catalog_file}}', 'catalog_id');
        $this->createIndex('idx-catalog_file-file_id', '{{%catalog_file}}', 'file_id');
        $this->addForeignKey('fk-catalog_file-catalog_id', '{{%catalog_file}}', 'catalog_id', '{{%catalog}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-catalog_file-file_id', '{{%catalog_file}}', 'file_id', '{{%file}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catalog_file}}');
        $this->dropTable('{{%catalog_image}}');
        $this->dropTable('{{%catalog}}');
        $this->dropTable('{{%catalog_category}}');
    }
}
