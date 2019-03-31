<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\forms\Report */

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $queryParams array */

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
            [
                'attribute' => 'wallet_to',
                'value' => 'walletTo.guid'
            ],
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

    <div class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-save-file"></i> JSON', ['/download/json'] + $queryParams, ['class' => 'btn btn-success', 'target' => '_blank'])?>
        <?= Html::a('<i class="glyphicon glyphicon-save-file"></i> XML', ['/download/xml'] + $queryParams, ['class' => 'btn btn-warning', 'target' => '_blank'])?>
    </div>

</div>
