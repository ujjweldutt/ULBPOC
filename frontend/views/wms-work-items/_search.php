<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WmsWorkItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wms-work-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'wms_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'number1') ?>

    <?php // echo $form->field($model, 'number2') ?>

    <?php // echo $form->field($model, 'number3') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'breadth') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'rate_type_id') ?>

    <?php // echo $form->field($model, 'total_rate') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
