<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

use frontend\models\VendorHeadOfficeCountry;
use frontend\models\VendorHeadOfficeState;
use frontend\models\VendorHeadOfficeDistrict;
use frontend\models\VendorBranchOfficeCountry;
use frontend\models\VendorBranchOfficeState;
use frontend\models\VendorBranchOfficeDistrict;
use frontend\models\VendorBankAccountType;
use common\components\Common;
/* @var $this yii\web\View */
/* @var $model frontend\models\VendorRegistration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-registration-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="card">
	  <div class="card-header">
		<b>Personal Information</b>
	  </div>
	  <div class="card-body">
		<div class="col-md-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Vendor Name'])->label(Yii::t('app', 'Vendor Name')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Vendor Email'])->label(Yii::t('app', 'Vendor Email')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'gst_no')->textInput(['maxlength' => true, 'placeholder' => 'Vendor GST No.'])->label(Yii::t('app', 'Vendor GST No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'pan_no')->textInput(['maxlength' => true, 'placeholder' => 'Vendor PAN No.'])->label(Yii::t('app', 'Vendor PAN No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'tin_no')->textInput(['maxlength' => true, 'placeholder' => 'Vendor TIN No.'])->label(Yii::t('app', 'Vendor TIN No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'permanent_address')->textarea(['rows' => 3, 'placeholder' => 'Permanent Address'])->label(Yii::t('app', 'Permanent Address')); ?>
		</div>
	  </div>
	</div>
    
	<div class="card">
	  <div class="card-header">
		<b>Head-Office Information</b>
	  </div>
	  <div class="card-body">
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_address1')->textInput(['maxlength' => true, 'placeholder' => 'Head Office Address1'])->label(Yii::t('app', 'Head Office Address1')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_address2')->textInput(['maxlength' => true, 'placeholder' => 'Head Office Address2'])->label(Yii::t('app', 'Head Office Address2')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_head_office_country_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorHeadOfficeCountry::find()->all(),'id','country_name')),['prompt' => Yii::t('app','Select Country')])->label(Yii::t('app', 'Head Office Country')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_head_office_state_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorHeadOfficeState::find()->where([])->all(),'state_code','state_name')),['prompt' => Yii::t('app','Select State')])->label(Yii::t('app', 'Head Office State')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_head_office_district_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorHeadOfficeDistrict::find()->where([])->all(),'district_code','district_name')),['prompt' => Yii::t('app','Select City')])->label(Yii::t('app', 'Head Office City')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_pin_code')->textInput(['placeholder' => 'Head Office PIN Code'])->label(Yii::t('app', 'Head Office PIN Code')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_telephone_no')->textInput(['placeholder' => 'Head Office Telephone No.'])->label(Yii::t('app', 'Head Office Telephone No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_mobile_no')->textInput(['placeholder' => 'Head Office Mobile No.'])->label(Yii::t('app', 'Head Office Mobile No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_company_url')->textInput(['maxlength' => true, 'placeholder' => 'Head Office Company URL'])->label(Yii::t('app', 'Head Office Company URL')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'head_office_business_established_year')->textInput(['maxlength' => true, 'placeholder' => 'Head Office Year Business Established'])->label(Yii::t('app', 'Head Office Year Business Established')); ?>
		</div>
	  </div>
	</div>

	<div class="card">
	  <div class="card-header">
		<b>Branch-Office Information</b>
	  </div>
	  <div class="card-body">
		<div class="col-md-6">
			<?= $form->field($model, 'branch_office_address1')->textInput(['maxlength' => true, 'placeholder' => 'Branch Office Address1'])->label(Yii::t('app', 'Branch Office Address1')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'branch_office_address2')->textInput(['maxlength' => true, 'placeholder' => 'Branch Office Address2'])->label(Yii::t('app', 'Branch Office Address2')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_branch_office_country_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorBranchOfficeCountry::find()->all(),'id','country_name')),['prompt' => Yii::t('app','Select Country')])->label(Yii::t('app', 'Branch Office Country')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_branch_office_state_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorBranchOfficeState::find()->where([])->all(),'state_code','state_name')),['prompt' => Yii::t('app','Select State')])->label(Yii::t('app', 'Branch Office State')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_branch_office_district_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorBranchOfficeDistrict::find()->where([])->all(),'district_code','district_name')),['prompt' => Yii::t('app','Select City')])->label(Yii::t('app', 'Branch Office City')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'branch_office_pin_no')->textInput(['placeholder' => 'Branch Office PIN Code'])->label(Yii::t('app', 'Branch Office PIN Code')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'branch_office_telephone_no')->textInput(['placeholder' => 'Branch Office Telephone No.'])->label(Yii::t('app', 'Branch Office Telephone No.')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'branch_office_mobile_no')->textInput(['placeholder' => 'Branch Office Mobile No.'])->label(Yii::t('app', 'Branch Office Mobile No.')); ?>
		</div>
	  </div>
	</div>
   
   <div class="card">
	  <div class="card-header">
		<b>Bank Information</b>
	  </div>
	  <div class="card-body">
		<div class="col-md-6">
			<?= $form->field($model, 'bank_name')->textInput(['maxlength' => true, 'placeholder' => 'Bank Name'])->label(Yii::t('app', 'Bank Name')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'bank_account_no')->textInput(['placeholder' => 'Bank Account No.'])->label(Yii::t('app', 'Bank Account No.')); ?>
		</div>
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_bank_account_type_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorBankAccountType::find()->where([])->all(),'id','name')),['prompt' => Yii::t('app','Select Account Type')])->label(Yii::t('app', 'Bank Account Type')); ?>
		</div>
		<div class="col-md-6">
			 <?= $form->field($model, 'ifsc_code')->textInput(['maxlength' => true, 'placeholder' => 'IFSC Code'])->label(Yii::t('app', 'IFSC Code')); ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'vendor_description')->textarea(['rows' => 3, 'placeholder' => 'Vendor Description'])->label(Yii::t('app', 'Vendor Description')); ?>
		</div>
	  </div>
	</div>
	
	<div class="card">
		<div class="form-group text-center">
			<div class="clearfix">&nbsp;</div>
			<?= Html::submitButton('Add Vendor', ['class' => 'btn btn-success btn-lg']) ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
<?php 
/* $this->registerJs(
'jQuery(document).ready(function(){ 
     
    jQuery("#'.Html::getInputId($model, 'vendor_head_office_state_id').'").change(function(){ 
       jQuery.get("'.Url::toRoute("/vendor-registration/get-district-by-state-id").'", { 
            vendor_head_office_state_id: jQuery(this).val() } )
            .done(function( data ) {
                    jQuery( "#'.Html::getInputId($model, 'vendor_head_office_district_id').'" ).html( data );
                }
            ); 
        
    });
});
', View::POS_READY, 'signupform-district'); */
?>