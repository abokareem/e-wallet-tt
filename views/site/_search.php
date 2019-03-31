<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'clientId')->dropDownList(['' => ''] + $model->getClientList()) ?>

    <?php if ($model->clientId): ?>
        <?= $form->field($model, 'walletId')->dropDownList(['' => ''] + $model->getClientWalletList()) ?>
    <?php endif ?>

    <?= $form->field($model, 'timeFrom')->input('datetime-local') ?>

    <?= $form->field($model, 'timeTo')->input('datetime-local') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', '/', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>