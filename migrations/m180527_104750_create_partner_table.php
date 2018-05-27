<?php

use yii\db\Migration;

/**
 * Handles the creation of table `partner`.
 */
class m180527_104750_create_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'seo_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'annotation' => $this->text(),
            'description' => $this->text(),
            'on_main' => $this->boolean()->defaultValue(1),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-partner-code', '{{%partner}}', 'code');
        $this->createIndex('idx-partner-on_main', '{{%partner}}', 'on_main');
        $this->createIndex('idx-partner-active', '{{%partner}}', 'active');
        $this->createIndex('idx-partner-image_id', '{{%partner}}', 'image_id');
        $this->createIndex('idx-partner-seo_id', '{{%partner}}', 'seo_id');
        $this->addForeignKey('fk-partner-image', '{{%partner}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-partner-seo', '{{%partner}}', 'seo_id', '{{%seo}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partner}}');
    }
}
