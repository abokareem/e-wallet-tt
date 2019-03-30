<?php

namespace app\modules\api\serializers;


use app\models\db\TransferLog;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;

class TransferSerializer extends BaseSerializer
{
    public $model = TransferLog::class;
    public $attributes = [
        'amount_in_usd',
        'amount',
        'walletFrom',
        'walletTo',
        'time',
        'info',
    ];

    public function getWalletTo($model)
    {
        return (new WalletSerializer($model->walletTo))->getData(false);
    }

    public function getWalletFrom($model)
    {
        if (!$model->walletFrom)
            return null;

        return (new WalletSerializer($model->walletFrom))->getData(false);
    }

    public function getInfo($model)
    {
        try {
            return Json::decode($model->info);
        } catch (InvalidArgumentException $ex) {
            return $model->info;
        }
    }
}