<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider`.
 */
class m180411_065033_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'type' => $this->tinyInteger()->defaultValue(1),
            'image_id' => $this->integer(),
            'icon_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'link' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'position' => $this->integer(),
        ]);

        $this->createIndex('idx-slider-image_id', '{{%slider}}', 'image_id');
        $this->addForeignKey('fk-slider-image', '{{%slider}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        
        $this->createIndex('idx-slider-icon_id', '{{%slider}}', 'icon_id');
        $this->addForeignKey('fk-slider-icon', '{{%slider}}', 'icon_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');
        
        $this->createIndex('idx-slider-active', '{{%slider}}', 'active');
        $this->createIndex('idx-slider-position', '{{%slider}}', 'position');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
