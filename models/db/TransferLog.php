<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "transfer_log".
 *
 * @property int $id
 * @property double $amount
 * @property double $amount_in_usd
 * @property int $wallet_from
 * @property int $wallet_to
 * @property string $time
 * @property string $info
 * @property Wallet $walletFrom
 * @property Wallet $walletTo
 */
class TransferLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfer_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount_in_usd', 'amount', 'wallet_from', 'wallet_to', 'info'], 'required'],
            [['amount_in_usd', 'amount'], 'number'],
            [['wallet_from', 'wallet_to'], 'integer'],
            [['time'], 'safe'],
            [['info'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'amount_in_usd' => 'Amount (USD)',
            'wallet_from' => 'Wallet From',
            'wallet_to' => 'Wallet To',
            'time' => 'Time',
            'info' => 'Info',
        ];
    }

    public function getWalletFrom()
    {
        return $this->hasOne(Wallet::class, ['id' => 'wallet_from']);
    }

    public function getWalletTo()
    {
        return $this->hasOne(Wallet::class, ['id' => 'wallet_to']);
    }

    public function beforeSave($insert)
    {
        if ($insert)
            $this->time = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }


}
