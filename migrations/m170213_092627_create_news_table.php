<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170213_092627_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%news_category}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-news_category-code', '{{%news_category}}', 'code');
        $this->createIndex('idx-news_category-active', '{{%news_category}}', 'active');
        $this->createIndex('idx-news_category-image_id', '{{%news_category}}', 'image_id');
        $this->createIndex('idx-news_category-parent_id', '{{%news_category}}', 'parent_id');
        $this->addForeignKey('fk-news_category-image', '{{%news_category}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-news_category-parent', '{{%news_category}}', 'parent_id', '{{%news_category}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'category_id' => $this->integer(),
            'image_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'annotation' => $this->text(),
            'description' => $this->text(),
            'author' => $this->string(),
            'external_link' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'created' => $this->timestamp()->notNull(),
        ]);

        $this->createIndex('idx-news-user_id', '{{%news}}', 'user_id');
        $this->createIndex('idx-news-category_id', '{{%news}}', 'category_id');
        $this->createIndex('idx-news-image_id', '{{%news}}', 'image_id');
        $this->createIndex('idx-news-seo_id', '{{%news}}', 'seo_id');
        $this->createIndex('idx-news-code', '{{%news}}', 'code');
        $this->createIndex('idx-news-active', '{{%news}}', 'active');
        $this->addForeignKey('fk-news-user', '{{%news}}', 'user_id', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-news-category', '{{%news}}', 'category_id', '{{%news_category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-news-image', '{{%news}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-news-seo', '{{%news}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%news}}');
        $this->dropTable('{{%news_category}}');
    }
}
