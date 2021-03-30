<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorRegistrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-registration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'gst_no') ?>

    <?= $form->field($model, 'pan_no') ?>

    <?php // echo $form->field($model, 'tin_no') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'head_office_address1') ?>

    <?php // echo $form->field($model, 'head_office_address2') ?>

    <?php // echo $form->field($model, 'vendor_head_office_country_id') ?>

    <?php // echo $form->field($model, 'vendor_head_office_state_id') ?>

    <?php // echo $form->field($model, 'vendor_head_office_district_id') ?>

    <?php // echo $form->field($model, 'head_office_pin_code') ?>

    <?php // echo $form->field($model, 'head_office_telephone_no') ?>

    <?php // echo $form->field($model, 'head_office_mobile_no') ?>

    <?php // echo $form->field($model, 'head_office_company_url') ?>

    <?php // echo $form->field($model, 'head_office_business_established_year') ?>

    <?php // echo $form->field($model, 'branch_office_address1') ?>

    <?php // echo $form->field($model, 'branch_office_address2') ?>

    <?php // echo $form->field($model, 'vendor_branch_office_country_id') ?>

    <?php // echo $form->field($model, 'vendor_branch_office_state_id') ?>

    <?php // echo $form->field($model, 'vendor_branch_office_district_id') ?>

    <?php // echo $form->field($model, 'branch_office_pin_no') ?>

    <?php // echo $form->field($model, 'branch_office_telephone_no') ?>

    <?php // echo $form->field($model, 'branch_office_mobile_no') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'bank_account_no') ?>

    <?php // echo $form->field($model, 'vendor_bank_account_type_id') ?>

    <?php // echo $form->field($model, 'ifsc_code') ?>

    <?php // echo $form->field($model, 'vendor_description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'modified_at') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
