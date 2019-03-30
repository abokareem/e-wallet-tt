<?php

namespace app\modules\api\controllers;

use app\models\db\Wallet;
use app\modules\api\models\ReplenishTransaction;
use app\modules\api\serializers\TransferSerializer;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class TransferController extends Controller
{

    public function actionTransaction()
    {
        return [];
    }

    public function actionReplenish($id)
    {
        if (!($wallet = Wallet::findOne(['guid' => $id])))
            throw new NotFoundHttpException();


        $model = new ReplenishTransaction();
        $model->wallet = $wallet;
        if ($model->load(Yii::$app->request->post(), '') && $model->transact()) {

            return (new TransferSerializer($model->log))->getData();
        }

        return $model->errors;
    }

}
