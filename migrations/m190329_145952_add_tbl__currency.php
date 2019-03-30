<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190329_145952_add_tbl__currency
 */
class m190329_145952_add_tbl__currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('currency');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190329_145952_add_tbl__currency cannot be reverted.\n";

        return false;
    }
    */
}
