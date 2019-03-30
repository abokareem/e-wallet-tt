<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $city
 * @property Wallet[] $wallets
 */
class Client extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'unique'],
            [['name', 'country', 'city'], 'required'],
            [['name', 'country', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country' => 'Country',
            'city' => 'City',
        ];
    }

    public function getWallets()
    {
        return $this->hasMany(Wallet::class, ['client_id' => 'id']);
    }
}
