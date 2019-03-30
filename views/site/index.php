<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\forms\Report */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Report page';
?>


<div class="site-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'amount',
            'amount_in_usd',
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
