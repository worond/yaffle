<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170126_093448_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%menu_category}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->integer()->defaultValue(1),
            'position' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('idx-menu_category-code', '{{%menu_category}}', 'code');
        $this->createIndex('idx-menu_category-active', '{{%menu_category}}', 'active');
        $this->createIndex('idx-menu_category-image_id', '{{%menu_category}}', 'image_id');
        $this->addForeignKey('fk-menu_category-image', '{{%menu_category}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'category_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'link' => $this->string(255)->notNull(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->boolean()->defaultValue(0),
        ]);

        $this->createIndex('idx-menu-parent_id', '{{%menu}}', 'parent_id');
        $this->createIndex('idx-menu-category_id', '{{%menu}}', 'category_id');
        $this->createIndex('idx-menu-active', '{{%menu}}', 'active');
        $this->addForeignKey('fk-menu-parent', '{{%menu}}', 'parent_id', '{{%menu}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-menu-category', '{{%menu}}', 'category_id', '{{%menu_category}}', 'id', 'SET NULL', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%menu}}');
        $this->dropTable('{{%menu_category}}');
    }
}
