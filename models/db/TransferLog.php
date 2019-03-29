<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "transfer_log".
 *
 * @property int $id
 * @property double $sum
 * @property int $wallet_from
 * @property int $wallet_to
 * @property string $time
 * @property string $info
 * @property Wallet $walletFrom
 * @property Wallet $walletTo
 */
class TransferLog extends \yii\db\ActiveRecord
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
            [['sum', 'wallet_from', 'wallet_to', 'time', 'info'], 'required'],
            [['sum'], 'number'],
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
            'sum' => 'Sum',
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
}
