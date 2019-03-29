<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class ClientController extends Controller
{

    public function actionList()
    {
        return [];
    }

    public function actionItem($id)
    {
        return 'item: $id';
    }

    public function actionCreate()
    {
        return 'post works!';
    }

    public function actionUpdate($id)
    {
        return "put works: $id";
    }
}
