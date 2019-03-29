<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class TransferController extends Controller
{

    public function actionTransaction()
    {
        return [];
    }

    public function actionDebit($id)
    {
        return 'item: $id';
    }

}
