<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\forms\Report */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Report page';
?>


<div class="site-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'amount',
                'value' => 'amount',
                'footer' => array_sum(array_map(function ($model) {
                    return $model->amount;
                }, $dataProvider->models)),
            ],
            [
                'attribute' => 'amount_in_usd',
                'value' => 'amount_in_usd',
                'footer' => array_sum(array_map(function ($model) {
                    return $model->amount_in_usd;
                }, $dataProvider->models)),
            ],
            [
                'attribute' => 'wallet_from',
                'value' => function ($model) {
                    return $model->walletFrom ? $model->walletFrom->guid : 'replenish';
                }
            ],
            'walletTo.guid',
            'time',
            [
                'attribute' => 'info',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::tag('pre', json_encode(json_decode($model->info), JSON_PRETTY_PRINT));
                }
            ],
        ],
    ]); ?>

</div>
