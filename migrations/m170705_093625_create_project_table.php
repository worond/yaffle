<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m170705_093625_create_project_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%project_category}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-project_category-code', '{{%project_category}}', 'code');
        $this->createIndex('idx-project_category-active', '{{%project_category}}', 'active');

        $this->createTable('{{%project}}', [
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

        $this->createIndex('idx-project-category_id', '{{%project}}', 'category_id');
        $this->createIndex('idx-project-image_id', '{{%project}}', 'image_id');
        $this->createIndex('idx-project-icon_id', '{{%project}}', 'icon_id');
        $this->createIndex('idx-project-thumbnail_id', '{{%project}}', 'thumbnail_id');
        $this->createIndex('idx-project-seo_id', '{{%project}}', 'seo_id');
        $this->createIndex('idx-project-code', '{{%project}}', 'code');
        $this->createIndex('idx-project-active', '{{%project}}', 'active');
        $this->addForeignKey('fk-project-category', '{{%project}}', 'category_id', '{{%project_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-project-image', '{{%project}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-project-icon', '{{%project}}', 'icon_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-project-thumbnail', '{{%project}}', 'thumbnail_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-project-seo', '{{%project}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%project_image}}', [
            'project_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-project_image', '{{%project_image}}', ['project_id', 'file_id']);

        $this->createIndex('idx-project_image-project_id', '{{%project_image}}', 'project_id');
        $this->createIndex('idx-project_image-file_id', '{{%project_image}}', 'file_id');

        $this->addForeignKey('fk-project_image-project_id', '{{%project_image}}', 'project_id', '{{%project}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-project_image-file_id', '{{%project_image}}', 'file_id', '{{%file}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%project_image}}');
        $this->dropTable('{{%project}}');
        $this->dropTable('{{%project_category}}');
    }
}
