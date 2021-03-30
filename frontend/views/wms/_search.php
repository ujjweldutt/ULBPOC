<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WmsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'work_code_number') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'ulb_id') ?>

    <?= $form->field($model, 'ward_id') ?>

    <?php // echo $form->field($model, 'scheme_id') ?>

    <?php // echo $form->field($model, 'component_id') ?>

    <?php // echo $form->field($model, 'financial_year_id') ?>

    <?php // echo $form->field($model, 'work_name') ?>

    <?php // echo $form->field($model, 'work_type') ?>

    <?php // echo $form->field($model, 'work_sub_type') ?>

    <?php // echo $form->field($model, 'work_scope') ?>

    <?php // echo $form->field($model, 'announcement_type') ?>

    <?php // echo $form->field($model, 'announcement_no') ?>

    <?php // echo $form->field($model, 'announcement_date') ?>

    <?php // echo $form->field($model, 'site_plan_file') ?>

    <?php // echo $form->field($model, 'cross_section_file') ?>

    <?php // echo $form->field($model, 'l_section_file') ?>

    <?php // echo $form->field($model, 'google_map_file') ?>

    <?php // echo $form->field($model, 'city_map_file') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_revised') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
