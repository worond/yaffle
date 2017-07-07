<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parameter`.
 */
class m170127_083023_create_parameter_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%parameter}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'code' => $this->string()->notNull()->unique(),
            'name' => $this->string(),
            'data' => $this->string(),
            'active' => $this->smallInteger()->defaultValue(1),
            'type' => $this->integer(),
            'position' => $this->integer(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-parameter-code','{{%parameter}}','code');
        $this->createIndex('idx-parameter-category_id','{{%parameter}}','category_id');
        $this->createIndex('idx-parameter-active','{{%parameter}}','active');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parameter}}');
    }
}
