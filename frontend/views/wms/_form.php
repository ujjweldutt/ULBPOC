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
use frontend\models\WorkType;
use frontend\models\SubTypeWork;
use frontend\models\MstAnnouncement;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */
/* @var $form yii\widgets\ActiveForm */

//echo "<pre>"; print_r(MstWard::find()->where(['is_active'=>'Y'])->all()); die;
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
            <?= $form->field($model, 'ward')->dropDownList(
         ArrayHelper::map(MstWard::find()->where(['is_active'=>'Y'])->all(), 'ward_number', 'ward_number'),[ 'multiple'=>'multiple']) ?>  
             
         </div>
         <div class="col-md-4">
             <?= $form->field($model, 'work_name')->textInput(['maxlength' => true]) ?>
         </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        <?= $form->field($model,'work_type')->dropDownList(
         ArrayHelper::map(WorkType::find()->where(['is_active'=>'Y'])->all(), 'id', 'work_name'),['prompt' => '-- Select Work Type --'])
        ?>
        
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'work_sub_type')->dropDownList(
                ArrayHelper::map(SubTypeWork::find()->where(['is_active'=>'Y'])->all(), 'id', 'sub_type_work'),['prompt' => '-- Select Sub Work Type --'])
                ?>
              
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
        <?= $form->field($model, 'announcement_type')->dropDownList(
                ArrayHelper::map(MstAnnouncement::find()->where(['is_active'=>'Y'])->all(), 'id', 'announcement_type'),['prompt' => '-- Type of Identification --'])
                ?>
        
         <?php // $form->field($model, 'announcement_type')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4 announcement">
             <?= $form->field($model, 'announcement_no')->textInput(['maxlength' => true]) ?>
         </div>

         <div class="col-md-4 announcement">
            <?= $form->field($model, 'announcement_date')->textInput() ?>
         </div>

       
        <div class="col-md-8 announcementdesc"  style="display:none;">
            <?= $form->field($model, 'announcement_desc')->textInput() ?>
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
        <?php echo $form->field($model, 'city_map_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
        </div>
        <div class="col-md-4">
        <?php //echo $form->field($model, 'google_map_file')->fileInput(["class"=>"form-control","accept"=>"image/x-png,image/gif,image/pdf","onchange"=>"uploadCheck('epassapplication-other_file')"]) ?>
           
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
   $( document ).ready(function() {
    $( "#wms-announcement_type" ).change(function() {
        var announcement_type=$(this).val();
        if(announcement_type==1){
            $("#wms-announcement_no").prop('required',true);
            $("#wms-announcement_date").prop('required',true);
            $(".announcement").css("display", "block");
            $(".announcementdesc").css("display", "none");
            $(".field-wms-announcement_no").addClass("required");
            $(".field-wms-announcement_date").addClass("required");
            

        }else if(announcement_type==2){

            $("#wms-announcement_no").prop('required',false);
            $("#wms-announcement_date").prop('required',false);
            $(".announcement").css("display", "block");
            $(".announcementdesc").css("display", "none");
            $(".field-wms-announcement_no").removeClass("required");
            $(".field-wms-announcement_date").removeClass("required");
            
           
        
        }else if(announcement_type==3){

            $("#wms-announcement_no").prop('required',false);
            $("#wms-announcement_date").prop('required',false);
            $(".announcement").css("display", "none");
            $(".announcementdesc").css("display", "block");
            $("#wms-announcement_desc").attr("required", "true"); 
            $(".field-wms-announcement_desc").addClass("required");
            
        
        }

    });

   });
</script>
