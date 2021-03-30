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
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\MstFinancialYear;
use frontend\models\MstScheme;
use frontend\models\MstComponent;
/* @var $this yii\web\View */
/* @var $model frontend\models\MstFinancialYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-form">

    <?php $form = ActiveForm::begin(); ?>
    
  <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'financial_year_id')->dropDownList(
         ArrayHelper::map(MstFinancialYear::find()->where(['is_active'=>'Y'])->andWhere(["is_deleted"=>'N'])->all(), 'id', 'financial_year'),['prompt' => '-- Select Finacial Year --'])
    ?>
   
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'scheme_id')->dropDownList(
         ArrayHelper::map(MstScheme::find()->all(), 'id', 'scheme'),['prompt' => '-- Select Scheme --'])
    ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <?= $form->field($model, 'component_id')->dropDownList(
           ArrayHelper::map(MstComponent::find()->all(), 'id', 'component'),['prompt' => '-- Select Component --'])
      ?>
    </div>
    <div class="col-md-6">
   
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    </div>
   </div>
   <div class="row">
   <div class="col-md-6">
   <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>
   
   </div>
   <div class="col-md-6">
    <?php //  $form->field($model, 'uploaded_file')->textInput(['maxlength' => true]) ?>
       <?php echo $form->field($model, 'uploaded_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
          
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
