<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m170213_101921_create_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'code' => $this->string(),
            'city' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'time' => $this->string(),
            'description' => $this->text(),
            'coordinates' => $this->string(),
            'external_link' => $this->string(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(1),
        ]);

        $this->createIndex('idx-contact-code', '{{%contact}}', 'code');
        $this->createIndex('idx-contact-active', '{{%contact}}', 'active');
        $this->createIndex('idx-contact-image_id', '{{%contact}}', 'image_id');
        $this->addForeignKey('fk-contact-image', '{{%contact}}', 'image_id', '{{%file}}', 'id', 'SET NULL', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%contact}}');
    }
}
