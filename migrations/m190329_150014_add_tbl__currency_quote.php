<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190329_150014_add_tbl__currency_quote
 */
class m190329_150014_add_tbl__currency_quote extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency_quote', [
            'id' => Schema::TYPE_PK,
            'date' => Schema::TYPE_DATE,
            'currency_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'quote' => Schema::TYPE_FLOAT . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('currency_quote');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190329_150014_add_tbl__currency_quote cannot be reverted.\n";

        return false;
    }
    */
}
