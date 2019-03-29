<?php

namespace app\modules\api\controllers;

use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class ClientController extends Controller
{
    /**
     * Renders the index view for the module
     * @return mixed
     */
    public function actionIndex()
    {
        return ['asdas' => [1,2,3]];
    }
}
