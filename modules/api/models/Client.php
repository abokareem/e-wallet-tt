<?php

namespace app\modules\api\models;

use app\models\db\Client as DBClient;
use app\models\db\Currency;
use app\models\db\Wallet;
use Yii;
use yii\base\Model;

class Client extends Model
{
    public $name;
    public $country;
    public $city;
    public $currency;

    public function rules()
    {
        return [
            [['name', 'country', 'city', 'currency'], 'required'],
//            [['name'], 'unique', 'targetClass' => DBClient::class],
            [['currency'], 'exist', 'targetClass' => Currency::class, 'targetAttribute' => 'name'],
            [['name', 'country', 'city'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 3],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'country' => 'Country',
            'city' => 'City',
            'currency' => 'Currency',
        ];
    }

    public function findOrCreateClient()
    {
        if (!!($model = DBClient::findOne(['name' => $this->name])))
            return $model;

        $model = new DBClient();
        $model->setAttributes($this->attributes);
        $model->save(false);

        return $model;
    }


    public function createWallet()
    {
        $client = $this->findOrCreateClient();
        $currency = Currency::getCurrencyByName($this->currency);

        $model = new Wallet();
        $model->client_id = $client->id;
        $model->currency_id = $currency->id;
        $model->balance = 0.00;
        $model->guid = Yii::$app->security->generateRandomString(8);

        $model->save();

        return $model;
    }
}