<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorAssignWorkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-assign-work-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vendor_registration_id') ?>

    <?= $form->field($model, 'reference_no') ?>

    <?= $form->field($model, 'agency_period_months') ?>

    <?= $form->field($model, 'agency_tendor_no') ?>

    <?php // echo $form->field($model, 'estimated_amount') ?>

    <?php // echo $form->field($model, 'work_start_date') ?>

    <?php // echo $form->field($model, 'work_completion_date') ?>

    <?php // echo $form->field($model, 'liability_period_days') ?>

    <?php // echo $form->field($model, 'brief_work_details') ?>

    <?php // echo $form->field($model, 'note_other_conditions') ?>

    <?php // echo $form->field($model, 'security_deposit') ?>

    <?php // echo $form->field($model, 'earnest_money_deposit') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
