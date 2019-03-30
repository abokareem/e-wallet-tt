<?php

namespace app\modules\api\serializers;


use app\models\db\Wallet;

class WalletSerializer extends BaseSerializer
{
    public $model = Wallet::class;
    public $attributes = [
        'currency',
        'balance',
        'guid',
    ];

    public function getCurrency($model)
    {
        return $model->currency->name;
    }
}