<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sector`.
 */
class m170705_093521_create_sector_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%sector_category}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-sector_category-code', '{{%sector_category}}', 'code');
        $this->createIndex('idx-sector_category-active', '{{%sector_category}}', 'active');

        $this->createTable('{{%sector}}', [
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

        $this->createIndex('idx-sector-category_id', '{{%sector}}', 'category_id');
        $this->createIndex('idx-sector-image_id', '{{%sector}}', 'image_id');
        $this->createIndex('idx-sector-icon_id', '{{%sector}}', 'icon_id');
        $this->createIndex('idx-sector-thumbnail_id', '{{%sector}}', 'thumbnail_id');
        $this->createIndex('idx-sector-seo_id', '{{%sector}}', 'seo_id');
        $this->createIndex('idx-sector-code', '{{%sector}}', 'code');
        $this->createIndex('idx-sector-active', '{{%sector}}', 'active');
        $this->addForeignKey('fk-sector-category', '{{%sector}}', 'category_id', '{{%sector_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-sector-image', '{{%sector}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-sector-icon', '{{%sector}}', 'icon_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-sector-thumbnail', '{{%sector}}', 'thumbnail_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-sector-seo', '{{%sector}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%sector_image}}', [
            'sector_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-sector_image', '{{%sector_image}}', ['sector_id', 'file_id']);

        $this->createIndex('idx-sector_image-sector_id', '{{%sector_image}}', 'sector_id');
        $this->createIndex('idx-sector_image-file_id', '{{%sector_image}}', 'file_id');

        $this->addForeignKey('fk-sector_image-sector_id', '{{%sector_image}}', 'sector_id', '{{%sector}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-sector_image-file_id', '{{%sector_image}}', 'file_id', '{{%file}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%sector_image}}');
        $this->dropTable('{{%sector}}');
        $this->dropTable('{{%sector_category}}');
    }
}
