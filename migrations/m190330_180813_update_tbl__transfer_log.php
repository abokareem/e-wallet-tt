<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Class m190330_180813_update_tbl__transfer_log
 */
class m190330_180813_update_tbl__transfer_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('transfer_log', 'sum', 'amount');
        $this->addColumn('transfer_log', 'amount_in_usd', Schema::TYPE_FLOAT . ' NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('transfer_log', 'amount', 'sum');
        $this->dropColumn('transfer_log', 'amount_in_usd');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190330_180813_update_tbl__transfer_log cannot be reverted.\n";

        return false;
    }
    */
}
