<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;

class TransferController extends Controller
{

    public function actionTransaction()
    {
        return [];
    }

    public function actionDebit($id)
    {
        return "item: $id";
    }

}
