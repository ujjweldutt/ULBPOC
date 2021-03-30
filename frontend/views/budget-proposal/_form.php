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
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\MstFinancialYear;
use frontend\models\MstScheme;
use frontend\models\MstComponent;
use frontend\models\MstUlb;
/* @var $this yii\web\View */
/* @var $model frontend\models\BudgetProposal */
/* @var $form yii\widgets\ActiveForm */

//echo "<pre>"; print_r($budgetmodel); die;
  
?>

<div class="budget-proposal-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
        <?= $form->field($budgetmodel, 'financial_year_id')->dropDownList(
         ArrayHelper::map(MstFinancialYear::find()->where(['is_active'=>'Y'])->andWhere(["is_deleted"=>'N'])->all(), 'id', 'financial_year'),['prompt' => '-- Select Finacial Year --'])
         ?>
   
        </div>
        <div class="col-md-4">
        <?= $form->field($budgetmodel, 'scheme_id')->dropDownList(
         ArrayHelper::map(MstScheme::find()->all(), 'id', 'scheme'),['prompt' => '-- Select Scheme --'])
    ?>
        </div>
        <div class="col-md-4">
      
        <?= $form->field($budgetmodel, 'component_id')->dropDownList(
           ArrayHelper::map(MstComponent::find()->all(), 'id', 'component'),['prompt' => '-- Select Component --'])
        ?>
        </div>
    </div>
    <div id="budget"></div>
    <div class="row">
        <div class="col-md-6">
         
         <?= $form->field($model, 'allocation_type')->dropDownList([ 'Auto' => 'Auto', 'On Demand' => 'On Demand', ], ['prompt' => 'Please Select']) ?>


        </div>
        <div class="col-md-6">
           
        </div>
    </div>

    <div class="row">
    <div class="col-md-12">
            <h3>Distribution of Grant MCs</h3>

            <table class="table">
                <tbody>
                    <?php 
                    $mcs=MstUlb::find()->where([
                        'is_active'=>'Y'
                        ]
                    )->all();

                    foreach($mcs as $key=>$val)
                    {?>

                   
                    <tr>
                        <td><input type="hidden"  name="ulb_id[]" value="<?=$val->id?>" /> <?=$val->name?></td>
                        <td><input type="text"  name="amount_demanded[<?=$val->id?>]" /> </td>
                    </tr>

                 <?php } ?>
                </tbody>
               
            </table>
            </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
$(document).ready(function(){ 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?=Yii::$app->request->getCsrfToken();?>'
    }
    });  


    $("#budget-component_id").change(function(){ 
       	 jQuery.get('<?= Url::toRoute('/budget-proposal/budget') ?>', { 
                component_id: jQuery(this).val(), scheme_id: jQuery('#budget-scheme_id').val(),
                financial_year_id: jQuery('#budget-financial_year_id').val(),
                } )
                .done(function( data ) {  
				$("#budget").html(data); 
                  }
                );  

    });
});
    </script>