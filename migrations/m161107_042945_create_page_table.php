<?php

use yii\db\Migration;

/**
 * Handles the creation for table `page`.
 */
class m161107_042945_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'image_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'action' => $this->string(),
            'url' => $this->string(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'annotation' => $this->text(),
            'description' => $this->text(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
            'sitemap' => $this->boolean()->defaultValue(1),
            'views' => $this->integer(),
        ]);

        $this->createIndex('idx-page-active', '{{%page}}', 'active');
        $this->createIndex('idx-page-code', '{{%page}}', 'code');
        $this->createIndex('idx-page-parent_id', '{{%page}}', 'parent_id');
        $this->createIndex('idx-page-url', '{{%page}}', 'url');
        $this->addForeignKey('fk-page-parent', '{{%page}}', 'parent_id', '{{%page}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-page-image', '{{%page}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-page-seo', '{{%page}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
