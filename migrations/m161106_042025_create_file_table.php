<?php

use yii\db\Migration;

/**
 * Handles the creation for table `file`.
 */
class m161106_042025_create_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'path' => $this->integer(),
            'ext' => $this->string(),
            'size' => $this->integer(),
            'width' => $this->integer(),
            'height' => $this->integer(),
            'alt' => $this->string(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%file}}');
    }
}
