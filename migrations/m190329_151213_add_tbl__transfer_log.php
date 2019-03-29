<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190329_151213_add_tbl__transfer_log
 */
class m190329_151213_add_tbl__transfer_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transfer_log', [
            'id' => Schema::TYPE_PK,
            'sum' => Schema::TYPE_FLOAT . ' NOT NULL',
            'wallet_from' => Schema::TYPE_INTEGER . ' NOT NULL',
            'wallet_to' => Schema::TYPE_INTEGER . ' NOT NULL',
            'time' => Schema::TYPE_DATETIME . ' NOT NULL',
            'info' => Schema::TYPE_TEXT. ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transfer_log');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190329_151213_add_tbl__transfer_log cannot be reverted.\n";

        return false;
    }
    */
}
