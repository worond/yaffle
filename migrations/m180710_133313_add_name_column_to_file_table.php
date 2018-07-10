<?php

use yii\db\Migration;

/**
 * Handles adding name to table `file`.
 */
class m180710_133313_add_name_column_to_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%file}}', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%file}}', 'title');
    }
}
