<?php

namespace app\modules\api\serializers;


use app\models\db\Client;
use yii\data\ActiveDataProvider;

class ClientSerializer extends BaseSerializer
{
    public $model = Client::class;
    public $attributes = [
        'id',
        'name',
        'country',
        'city',
        'wallets',
    ];

    public function getWallets($model)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getWallets(),
        ]);
        return (new WalletSerializer($dataProvider, true))->getData(false);
    }
}