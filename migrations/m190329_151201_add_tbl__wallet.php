<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190329_151201_add_tbl__wallet
 */
class m190329_151201_add_tbl__wallet extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('wallet', [
            'id' => Schema::TYPE_PK,
            'guid' => Schema::TYPE_STRING . ' NOT NULL',
            'client_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'currency_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'balance' => Schema::TYPE_FLOAT . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('wallet');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190329_151201_add_tbl__wallet cannot be reverted.\n";

        return false;
    }
    */
}
