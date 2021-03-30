
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

use frontend\models\VendorRegistration;
use common\components\Common;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorAssignWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-assign-work-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-6">
			<?php echo  $form->field($model, 'vendor_registration_id')->dropDownList(Common::transarray(ArrayHelper::map(VendorRegistration::find()->all(),'id','name')),['prompt' => Yii::t('app','Select Vendor')])->label(Yii::t('app', 'Select Vendor')); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'agency_period_months')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'agency_tendor_no')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'estimated_amount')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'work_start_date')->textInput(['class' => 'form-control', 'id' => 'my_date_picker']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'work_completion_date')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'liability_period_days')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'brief_work_details')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'note_other_conditions')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'security_deposit')->textInput() ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'earnest_money_deposit')->textInput() ?>
		</div>
		<div class="col-md-6">
		
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="clearfix">&nbsp;</div>
			<?= Html::submitButton('Assign Work/Add Vendor Details', ['class' => 'btn btn-success btn-lg']) ?>
		</div>
	</div>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'is_active')->dropDownList([ 'N' => 'N', 'Y' => 'Y', ], ['prompt' => '']) ?>

    <?php ActiveForm::end(); ?>

</div>