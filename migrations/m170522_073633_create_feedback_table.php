<?php

use yii\db\Migration;

class m170522_073633_create_feedback_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'image_id' => $this->integer(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'subject' => $this->string(),
            'message' => $this->text(),
            'answer' => $this->text(),
            'created_at' => $this->timestamp(),
            'active' => $this->boolean()->defaultValue(1),
            'viewed' => $this->boolean()->defaultValue(0),
            'url' => $this->string(),
        ]);

        $this->createIndex('idx-feedback-user_id','{{%feedback}}','user_id');
        $this->createIndex('idx-feedback-image_id','{{%feedback}}','image_id');
        $this->createIndex('idx-feedback-active','{{%feedback}}','active');
        $this->addForeignKey('fk-feedback-user','{{%feedback}}','user_id','{{%user}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-feedback-image','{{%feedback}}','image_id','{{%file}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%feedback}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
