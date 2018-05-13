<?php

use yii\db\Migration;

/**
 * Handles adding city_id to table `contact`.
 */
class m180412_052625_add_city_id_column_to_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%contact}}', 'city');
        $this->addColumn('{{%contact}}', 'city_id', $this->integer()->after('id'));
        $this->addColumn('{{%contact}}', 'fax', $this->string()->after('phone'));
        $this->addColumn('{{%contact}}', 'director', $this->string()->after('email'));
        $this->addColumn('{{%contact}}', 'managers', $this->text()->after('director'));
        $this->addColumn('{{%contact}}', 'default', $this->boolean()->after('external_link'));

        $this->createIndex('idx-contact-city_id', '{{%contact}}', 'city_id');
        $this->addForeignKey('fk-contact-city_id', '{{%contact}}', 'city_id', '{{%city}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%contact}}', 'city', $this->string());

        $this->dropForeignKey('fk-contact-city_id', '{{%contact}}');
        $this->dropColumn('{{%contact}}', 'city_id');
        $this->dropColumn('{{%contact}}', 'fax');
        $this->dropColumn('{{%contact}}', 'director');
        $this->dropColumn('{{%contact}}', 'managers');
    }
}
