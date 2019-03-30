<?php

namespace app\modules\api\serializers;


use app\models\db\Wallet;

class ClientWalletSerializer extends BaseSerializer
{
    public $model = Wallet::class;
    public $attributes = [
        'name',
        'country',
        'city',
        'currency',
        'balance',
        'guid',
    ];

    public function getCurrency($model)
    {
        return $model->currency->name;
    }

    public function getName($model)
    {
        return $model->client->name;
    }

    public function getCountry($model)
    {
        return $model->client->country;
    }

    public function getCity($model)
    {
        return $model->client->city;
    }
}