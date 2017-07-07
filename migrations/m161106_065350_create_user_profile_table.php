<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile`.
 */
class m161106_065350_create_user_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'image_id' => $this->integer(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'birthday' => $this->date(),
            'discount' => $this->integer(),
        ]);

        $this->createIndex('idx-user_profile-user_id','{{%user_profile}}','user_id');
        $this->createIndex('idx-user_profile-image_id','{{%user_profile}}','image_id');
        $this->createIndex('idx-user_profile-name','{{%user_profile}}','name');
        $this->createIndex('idx-user_profile-phone','{{%user_profile}}','phone');
        $this->createIndex('idx-user_profile-email','{{%user_profile}}','email');
        $this->addForeignKey('fk-user_profile-user','{{%user_profile}}','user_id','{{%user}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk-user_profile-image','{{%user_profile}}','image_id','{{%file}}','id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user_profile}}');
    }
}
