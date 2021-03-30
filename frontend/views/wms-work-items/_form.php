<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\MstFinancialYear;
use frontend\models\MstScheme;
use frontend\models\MstComponent;
use frontend\models\MstItems;
use frontend\models\MstUlb;
use frontend\models\MstWard;
use frontend\models\Wms;
use frontend\models\WmsWorkItems;

use yii\grid\GridView;
use yii\widgets\Pjax;

//echo Yii::$app->controller->action->id; die; 

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */
/* @var $form yii\widgets\ActiveForm */

/*$FinancialYear = ArrayHelper::map(
    MstFinancialYear::find()->asArray()->all(),
    'id',
    function($model) {
        return $model['start_year'].'-'.$model['end_year'];
    }
  );*/
  
  $MstScheme = ArrayHelper::map(MstScheme::find('id', 'scheme')->all(),'id','scheme');
  $component = ArrayHelper::map(MstComponent::find('id', 'component')->all(),'id','component');
  $MstItems = ArrayHelper::map(MstItems::find('id', 'item_name')->all(),'id','item_name');
  $MstUlb = ArrayHelper::map(MstUlb::find('id', 'name')->all(),'id','name');
  $MstWard = ArrayHelper::map(MstWard::find('id', 'ward_number')->all(),'id','ward_number');
 
?>

<div class="wms-work-items-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-3">
    
   


    <?php if(Yii::$app->controller->action->id == 'update'){
           echo $form->field($model, 'wms_id')->dropDownList(
            ArrayHelper::map(Wms::find()->where(['is_active'=>'Y'])->all(), 'id', 'work_code_number'),['prompt' => '-- Select Work Item --']);
         
    }else { 
        echo '<label class="control-label" for="wms-workcode">Work Code</label>';
       echo Html::input('text', 'workcodenumber', $wmsmodel->work_code_number,['class' => 'form-control','disabled'=>'disabled']); 
    }
    ?>


   
     </div>
    <div class="col-md-3">
   
    <?php if(Yii::$app->controller->action->id == 'update'){
          echo $form->field($wmsmodel, 'work_name')->dropDownList(
            ArrayHelper::map(Wms::find()->where(['is_active'=>'Y'])->all(), 'id', 'work_name'),['prompt' => '-- Select Work Item --']);
    }else{
     echo '<label class="control-label" for="wms-workname">Name of work</label>';
    echo  Html::input('text', 'workname', $wmsmodel->work_name,['class' => 'form-control','disabled'=>'disabled']); 
    }
    ?>
   

    </div>
    <div class="col-md-3">  
   
    <?php
    
    
    
    if(Yii::$app->controller->action->id == 'update'){
        echo  $form->field($wmsmodel, 'scheme_id')->dropDownList(
            ArrayHelper::map(MstScheme::find()->where(['is_active'=>'Y'])->all(), 'id', 'scheme'),['prompt' => '-- Select Work Item --']);
    }else{
        echo '<label class="control-label" for="wms-scheme">Scheme Name</label>';
        echo Html::input('text', 'scheme', $wmsmodel->scheme->scheme,['class' => 'form-control','disabled'=>'disabled']);
    }
 
    ?>
   
         
    </div>
    <div class="col-md-3">  
        <?= $form->field($model, 'item_id')->dropDownList(
         ArrayHelper::map(MstItems::find()->where(['is_active'=>'Y'])->all(), 'id', 'item_name'),['prompt' => '-- Select Work Item --']) 
         ?>

         <?=$form->field($model,'wms_id')->hiddenInput(['value'=>$wmsmodel->id])->label(false);?>
        
        
    </div>

</div><br><br><br>
<div class="row">
    <table class="table">
       
        <tr>
            <td> 
        
            <?php if(Yii::$app->controller->action->id == 'update'){
                    echo '<td>'.$form->field($model, 'item_id')->textInput().'</td>';
            }else{
                echo '<label class="control-label" for="wms-scheme">Item</label>';
               echo  Html::input('text', 'itemid', '',['class' => 'form-control','id'=>'itemid','disabled'=>'disabled']);
            } ?>
            
            <?=$form->field($model,'wms_id')->hiddenInput(['value'=>$wmsmodel->id])->label(false);?>
            <?=$form->field($model,'rate_type_id')->hiddenInput(['value'=>$wmsmodel->id])->label(false);?>
            <td> <?= $form->field($model, 'description')->textInput() ?></td> 
            <td><?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'number1')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'number2')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'number3')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'breadth')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'quantity')->textInput() ?></td>
        </tr>
    </table>
</div>

<div class="row">
<div class="col-md-12">
    <h3>View Items</h3>
    

    <table class="table">

        <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'wms_id',
            'item.item_name',
            'description',
            'remarks',
            'number1',
            'number2',
            'number3',
            'length',
            'breadth',
            'height',
            'unit',
            'quantity',
           // 'rate_type_id',
           // 'total_rate',
           // 'total_amount',
           // 'status',
           // 'created_on',
           // 'updated_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php Pjax::end(); ?>
         
     
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


    $("#wmsworkitems-item_id").change(function(){ 
       	 jQuery.get('<?= Url::toRoute('wms-work-items/get-items') ?>', { 
                item_id: jQuery(this).val()
                },{'dataType' : "json"})
                .done(function( data ) { 
                     if(data.trim()!=''){
                        data = $.parseJSON(data);
                        $("#itemid").val(data.item_name); 
                        $("#wmsworkitems-description").val(data.item_description); 
                        //$("#wmsworkitems-item_id").html(data.item); 
                        //$("#wmsworkitems-item_id").html(data.item); 
                        //$("#wmsworkitems-item_id").html(data.item); 
                        //$("#wmsworkitems-item_id").html(data.item); 
                        //$("#wmsworkitems-item_id").html(data.item); 
                        //$("#wmsworkitems-item_id").html(data.item); 

                     }
				   
                  }
                );  

    });
});
    </script>
