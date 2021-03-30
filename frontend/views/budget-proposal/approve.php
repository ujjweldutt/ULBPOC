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

<div class="budget-proposal-form">
    <h1>Proposal Details</h1>
    
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

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th>Total Grant (Rs)</th>
                    <th>Proposal in Process (Rs)</th>
                    <th>Proposal Approved (Rs)</th>
                    <th>Balance (Rs)</th>
                </tr>
                <tr>
                    <td><?=$budgetmodel->amount?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        </div>
     </div>

    <div class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'uploaded_file')->fileInput() ?>
        </div>
    </div>

    <div class="form-group">
      
        <button class="btn btn-success" type="submit" name="proposlaapprove">Approve</button>
          <button type="submit" name="proposlreject" class="btn btn-danger">Reject</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
