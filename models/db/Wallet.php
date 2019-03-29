<?php

namespace app\models\db;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property string $guid
 * @property int $client_id
 * @property int $currency_id
 * @property double $balance
 * @property Currency $currency
 * @property Client $client
 */
class Wallet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['guid'], 'unique'],
            [['guid', 'client_id', 'currency_id', 'balance'], 'required'],
            [['client_id', 'currency_id'], 'integer'],
            [['balance'], 'number'],
            [['guid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guid' => 'Guid',
            'client_id' => 'Client ID',
            'currency_id' => 'Currency ID',
            'balance' => 'Balance',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }
}
