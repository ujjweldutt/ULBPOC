<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\MstFinancialYear;
use frontend\models\MstScheme;
use frontend\models\MstComponent;
use frontend\models\MstItems;
use frontend\models\MstUlb;
use frontend\models\MstWard;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
   form div.required label.control-label:after {
   content:" * ";
   color:red;
   }
   .ajaxErrors,.file-upload-error{
     color:red;
   }
   
   form div.required label.control-label:after {
   content:" * ";
   color:red;
   }
   .ajaxErrors,.file-upload-error{
     color:red;
   }
   @media only screen and (min-width: 991px) {
      .movement-details{
      margin-left: 13px;
      font-weight: 800;
   }
   }
   .movement-details{
     margin-bottom: 20px;
   }

</style>
<div class="wms-form">

    <?php $form = ActiveForm::begin(); ?>
   
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'ulb_id')->dropDownList(
         ArrayHelper::map(MstUlb::find()->where(['is_active'=>'Y'])->all(), 'id', 'name'),['prompt' => '-- Select MC Name --'])
    ?>
    </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ward_id')->dropDownList(
         ArrayHelper::map(MstWard::find()->where(['is_active'=>'Y'])->all(), 'id', 'ward_number'),['prompt' => '-- Select Ward No --']) ?>
             
         </div>
         <div class="col-md-4">
             <?= $form->field($model, 'work_name')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'work_type')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'work_sub_type')->textInput(['maxlength' => true]) ?>
         </div>

         <div class="col-md-4">
             <?= $form->field($model, 'work_scope')->textInput(['maxlength' => true]) ?>
         </div>
    </div>

    <div class="row">
        <div class="col-md-4">
		<?= $form->field($model, 'financial_year_id')->dropDownList(
         ArrayHelper::map(MstFinancialYear::find()->where(['is_active'=>'Y'])->andWhere(["is_deleted"=>'N'])->all(), 'id', 'financial_year'),['prompt' => '-- Select Finacial Year --'])
    ?>
        <?php // $form->field($model, 'financial_year_id')->dropDownList($FinancialYear) ?>

        </div>
        <div class="col-md-4">
         <?= $form->field($model, 'scheme_id')->dropDownList(
         ArrayHelper::map(MstScheme::find()->where(['is_active'=>'Y'])->all(), 'id', 'scheme'),['prompt' => '-- Select Scheme --']) ?>
         </div>

         <div class="col-md-4">
             <?= $form->field($model, 'component_id')->dropDownList(
         ArrayHelper::map(MstComponent::find()->where(['is_active'=>'Y'])->all(), 'id', 'component'),['prompt' => '-- Select Component --']) ?>
         
         </div>
    </div>

    <div class="row">
        <div class="col-md-4">
        
         <?= $form->field($model, 'announcement_type')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'announcement_no')->textInput(['maxlength' => true]) ?>
         </div>

         <div class="col-md-4">
            <?= $form->field($model, 'announcement_date')->textInput() ?>
         </div>
    </div>

    <div class="row">
        <div class="col-md-4">
         <?php echo $form->field($model, 'site_plan_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'cross_section_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
        </div>

         <div class="col-md-4">
             <?php echo $form->field($model, 'l_section_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
         </div>
    </div>
    <div class="row">
        <div class="col-md-4">
         <?php echo $form->field($model, 'google_map_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'city_map_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
        </div>

         
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">

function uploadCheck(id){
      var upl = document.getElementById(id);
      var max = 3000000;
      $(".file-upload-error").empty();
      console.log(upl.files[0].size);
      if(upl.files[0].size > max)
      {
          $(".file-upload-error").html("<br>Please upload max 3MB file");
          alert("Please upload max 3MB file");
          upl.value = "";
      }
   }
</script>
