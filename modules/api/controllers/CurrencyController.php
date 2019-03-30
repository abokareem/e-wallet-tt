<?php

namespace app\modules\api\controllers;

use app\modules\api\models\Currency;
use Yii;
use yii\rest\Controller;
use yii\web\UploadedFile;


class CurrencyController extends Controller
{

    public function actionList()
    {
        return [];
    }

    public function actionUpdate()
    {
        $model = new Currency();

        $model->load(Yii::$app->request->post(), '');
        $model->file = UploadedFile::getInstanceByName('file');

        if ($model->tryLoad()) {
            return ['status' => 'ok'];
        }

        return $model->errors;
    }

}
