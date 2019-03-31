<?php

namespace app\controllers;

use app\models\forms\Report;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchModel = new Report();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'queryParams' => $queryParams,
        ]);
    }

    public function actionDownload($format)
    {
        $format = strtoupper($format);
        if (!in_array($format, ['JSON', 'XML']))
            throw new ForbiddenHttpException('Incorrect format');

        $app = Yii::$app;
        $searchModel = new Report();
        $dataProvider = $searchModel->search($app->request->queryParams);

        $data = array_map(function ($model) {
            $model->wallet_from = $model->walletFrom ? $model->walletFrom->guid : 'replenish';
            $model->wallet_to = $model->walletTo->guid;
            $model->info = Json::decode($model->info);
            return $model;
        }, $dataProvider->query->all());

        if ($format === 'JSON')
            return $this->asJson($data);
        return $this->asXml($data);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public
    function actionAbout()
    {
        return $this->render('about');
    }
}
