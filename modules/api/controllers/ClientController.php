<?php

namespace app\modules\api\controllers;

use app\models\db\Client as DBClient;
use app\modules\api\models\Client;
use app\modules\api\serializers\ClientSerializer;
use app\modules\api\serializers\ClientWalletSerializer;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Application;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `api` module
 */
class ClientController extends Controller
{
    /** @var Application */
    private $app;

    public function init()
    {
        parent::init();

        $this->app = \Yii::$app;
    }


    public function actionList()
    {
        try {
            $dataProvider = new ActiveDataProvider([
                'query' => DBClient::find()
            ]);
            $serializer = new ClientSerializer($dataProvider, true);
            return $serializer->getData();
        } catch (\Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    public function actionItem($id)
    {
        try {
            $serializer = new ClientSerializer(DBClient::findOne($id));
            return $serializer->getData();
        } catch (\Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    public function actionCreate()
    {
        $model = new Client();

        if ($model->load($this->app->request->post(), '') && $model->validate()) {
            $wallet = $model->createWallet();
            return (new ClientWalletSerializer($wallet))->getData();
        }

        return $model->errors;
    }

    public function actionUpdate($id)
    {
        return "put works: $id";
    }
}
