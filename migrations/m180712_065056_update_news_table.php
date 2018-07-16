<?php

use yii\db\Migration;

/**
 * Class m180712_065056_update_news_table
 */
class m180712_065056_update_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'subtitle', $this->string());
        $this->addColumn('{{%news}}', 'image_title', $this->string());
        $this->addColumn('{{%news}}', 'additional_description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%news}}', 'subtitle');
        $this->dropColumn('{{%news}}', 'image_title');
        $this->dropColumn('{{%news}}', 'additional_description');
    }
}
