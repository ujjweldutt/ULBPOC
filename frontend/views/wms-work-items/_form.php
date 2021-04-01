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
<style>
.cursor-pointer{
  cursor: pointer;
}
</style>
<div class="wms-work-items-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-3">
    
   


    <?php if(Yii::$app->controller->action->id == 'update'){
           echo $form->field($model, 'wms_id')->dropDownList(
            ArrayHelper::map(Wms::find()->where(['is_active'=>'Y'])->all(), 'id', 'work_code_number'),['prompt' => '-- Select Work Item --']);
         
    }else { 
        echo '<label class="control-label" for="wms-workcode">Work Code</label>';
       echo Html::input('text', 'workcodenumber', $wmsmodel->work_code_number,['class' => 'form-control','disabled'=>'disabled','id'=>'workcode','postval'=> $wmsmodel->id]); 
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

         <?=$form->field($model,'wms_id')->hiddenInput(['value'=>$wmsmodel->id,'id'=>'wmsID'])->label(false);?>
        
        
    </div>

</div><br><br><br>
<div class="row">
    <table class="table" id="listitem">
       
        <tr>
            <td> 
        
            <?php //if(Yii::$app->controller->action->id == 'update'){
                  //  echo '<td>'.$form->field($model, 'item_id')->textInput().'</td>';
           // }else{
              //  echo '<label class="control-label" for="wms-scheme">Item</label>';
              // echo  Html::input('text', 'itemid', '',['class' => 'form-control','id'=>'itemid','disabled'=>'disabled']);
          //  } ?>
             <label class="control-label" >Item</label>
            <select class="form-control" name="itemslist" id="itmeslist">
           
            </select>
            <?php //echo $form->field($model,'wms_id')->hiddenInput(['value'=>$wmsmodel->id])->label(false);?>
            <?php //echo $form->field($model,'rate_type_id')->hiddenInput(['value'=>$wmsmodel->id])->label(false);?>
            <td> <?= $form->field($model, 'description')->textInput() ?></td> 
            <td><?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'number1')->textInput(['maxlength' => true,'onkeyup'=>"getquantity()"]) ?></td>
            <td><?= $form->field($model, 'length')->textInput(['maxlength' => true,'onkeyup'=>"getquantity()"]) ?></td>
            <td><?= $form->field($model, 'breadth')->textInput(['maxlength' => true,'onkeyup'=>"getquantity()"]) ?></td>
            <td><?= $form->field($model, 'height')->textInput(['maxlength' => true,'onkeyup'=>"getquantity()"]) ?></td>
            <td><?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'quantity')->textInput() ?></td>
            <td><select id="rate_type_id" class="form-control"></select>
        </td>
        </tr>
    </table>

    
    <button class="btn btn-info" style="margin-left:10px;margin-right:10px;margin-bottom:50px" type="button" id="insert-more" onclick="addItems()">Add Item</button>&nbsp;
    <button class="btn btn-danger"  style="margin-left:10px;margin-right:10px;margin-bottom:50px" type="button" id="delete-row">Deduct Item</button>

</div>

<div class="row">
<div class="col-md-12">
    <h3>View Items</h3>
    

    <table class="table">
      

        <tbody id="itemtables">
        <thead>
            <th>Item</th>
            <th>Decription</th>
            <th>Remarks</th>
            <th>Number</th>
            <th>Length</th>
            <th>Breadth</th>
            <th>Height</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Action</th>
        </thead>
                    <?php  
                     if(!empty($dataWmsWork)){
                     foreach($dataWmsWork as $key =>$val){
                       
                         ?>

                    <tr>
                       <td><?=$val->item->item_name?></td>
                       <td><?=$val->description?></td>
                       <td><?=$val->remarks?></td>
                       <td><?=$val->number1?></td>
                       <td><?=$val->length?></td>
                       <td><?=$val->breadth?></td>
                       <td><?=$val->height?></td>
                       <td><?=$val->unit?></td>
                       <td><?=$val->quantity?></td>
                       <td><a class="btn btn-warning modelblock1"  data-id="<?=$val->id?>" href="#"  id="SModal<?=$val->id?>" data-toggle="modal" data-target="#SModal">Edit</a>&nbsp;
                       <a class="btn btn-danger modelblockdelete"  data-id="<?=$val->id?>" href="#"   data-toggle="modal" data-target="#DModal">Delete</a>
                      
                       </td>
                    </tr>

                    <?php }} ?>
        </tbody>
      
    </table>

</div>
</div>
    
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

   
<div class="modal fade" id="ItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:50%;">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">Please Select Item</h4>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body">
      <div style="text-align:center"><span class="" id="loader"></span></div>
      <div id="itemdiv"></div>
      </div>
      <div class="modal-footer">
     
     </div>
    </div>
  </div>
</div>





<div class="modal" id="DModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">Delete</h4>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= Url::toRoute(['wms-work-items/update-estimate-details'])?>" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <h3>Are You sure want to delete this ?</h3>
            <input type="hidden" id="wms_itemid" name="wms_item_id"   /> 
     
      </div>
      <div class="modal-footer">
      <button class="btn btn-info" name="wmsitem_delete" >Delete</button>
     </div>
     </form> 
    </div>
  </div>
</div>
  
<div class="modal" id="SModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">Edit</h4>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= Url::toRoute(['wms-work-items/update-estimate-details'])?>" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <table class="table table-striped table-bordered" >
                <tbody>
                   

                    <tr>
                         <td>Item Type :</td>
                       <td><input type="text" id="item_name" name="item_name"  class="form-control" readonly /> 
                       <input type="hidden" id="wms_item_id" name="wms_item_id"   /> 
                       </td>
                       <td>Item Number :</td>
                       <td><input type="text" id="item_no" name="item_no"    class="form-control" readonly /> </td>
                    </tr>

                    <tr>
              
                    <td>Description :</td>
                        
                   <td> <input type="text" id="description"  name="description"  class="form-control"/>  </td>
                    <td>Remarks :</td>
                       <td><input type="text" id="remarks" name="remarks"  class="form-control"/> </td>
                    </tr>
                   <tr>
                   <td>Numbers :</td>
                   <td><input type="text" id="number1" name="number1"  class="form-control"/> </td>
                        <td>Length :</td>
                   
                       <td><input type="text" id="length" name="length"  class="form-control"  onkeyup="getquantity()" /> </td>
                    </tr>
                      <tr>
                      <td>Breadth :</td>
                      <td><input type="text" id="breadth" name="breadth"  class="form-control"  onkeyup="getquantity()" /> </td>
                        <td>Height :</td>
                       <td><input type="text" id="height" name="height"  class="form-control"  onkeyup="getquantity()" /> </td>
                      </tr>
                     <tr>
                     <td>Unit :</td>
                     <td><input type="text" id="unit" name="unit"   class="form-control"/> </td>
                        <td>Qty :</td>
                    
                       <td><input type="text" id="quantity" name="quantity"  class="form-control" /> </td>

                     </tr>
                     

                </tbody>
        </table>
            <button class="btn btn-info" name="wmsitem_update" >Update</button>
      </form> 
      </div>
      <div class="modal-footer">
     
     </div>
    </div>
  </div>
</div>


<div class="modal" id="DModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">Delete</h4>
        <button type="button"  class="btn-close" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= Url::toRoute(['wms-work-items/update-estimate-details'])?>" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <h3>Are You sure want to delete this ?</h3>
            <input type="hidden" id="wms_itemid" name="wms_item_id"   /> 
     
      </div>
      <div class="modal-footer">
      <button class="btn btn-info" name="wmsitem_delete" >Delete</button>
     </div>
     </form> 
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){ 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?=Yii::$app->request->getCsrfToken();?>'
    }
    });  


    // $("#wmsworkitems-item_id").change(function(){ 
    //    	 jQuery.get('<?php //Url::toRoute('wms-work-items/get-items') ?>', { 
    //             item_id: jQuery(this).val()
    //             },{'dataType' : "json"})
    //             .done(function( data ) { 
    //                  if(data.trim()!=''){
    //                     data = $.parseJSON(data);
    //                     $("#itemid").val(data.item_name); 
    //                     $("#wmsworkitems-description").val(data.item_description); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 
    //                     //$("#wmsworkitems-item_id").html(data.item); 

    //                  }
				   
    //               }
    //             );  

    // });
});


$(document).on("click", ".modelblock1", function () {
    var id= $(this).attr('data-id');
    var url="<?= Url::toRoute(['wms-work-items/edit-estimate-details'])?>";
    $("#SModal"+id).attr("href",url);

    $.ajax({
        url: url,
            type: "GET",
            data: { id: id },
            success: function(response){
                 var res=JSON.parse(response);
                 
                $('#wms_item_id').val(res.id);
                $('#item_name').val(res.item_name);
                $('#item_no').val(res.item_no);
                $('#description').val(res.description);
                $('#remarks').val(res.remarks);
                $('#number1').val(res.number1);
                $('#length').val(res.length);
                $('#breadth').val(res.breadth);
                $('#height').val(res.height);
                $('#unit').val(res.unit);
                $('#quantity').val(res.quantity);
            },
            error: function(){
                  // do action
            }
      });

    });

    if(id>0){
       $.ajax({
            url: "<?= Url::toRoute('/wms/get-ratetypelist') ?>",
            type: "GET",
            data: { itemid: id },
            success: function(response){
                
                $('#rate_type_id').append(response);
            },
            error: function(){
                // do action
            }
        });
    }

</script>




<script>
$( document ).ready(function() {
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?=Yii::$app->request->getCsrfToken();?>'
    }
    }); 

    $( "#wmsworkitems-item_id" ).change(function() {
      
      var item_type_id=$(this).val();
      if(item_type_id.length>0)
      {
        $.ajax({
            url: "<?= Url::toRoute('/wms/get-items') ?>",
            type: "GET",
            data: { item_type_id: item_type_id },
            success: function(response){
                  $('#ItemModal').modal('show');
                  $('#itemdiv').html(response);
            },
            error: function(){
                  // do action
            }
      });
      }
    
    });


   
    
});

function getitemlist(itemid)
{
    $.ajax({
            url: "<?= Url::toRoute('/wms/get-itemslist') ?>",
            type: "GET",
            data: { itemid: itemid },
            success: function(response){
                  $('#ItemModal').modal('show');
                  $('#itemdiv').html(response);
            },
            error: function(){
                  // do action
            }
      });
}

function getitem(id)
{
    var name= $('.getitem').attr('data-item');
    var unit= $('.getitem').attr('data-unit');
    var desc= $('.getitem').attr('data-des');
   
    var sel = document.getElementById("itmeslist");
    var opt = document.createElement("option");
    opt.value = id;
    opt.text = name;
    opt.selected=true;
    sel.add(opt, null);

    if(typeof desc === "undefined"){document.getElementById("wmsworkitems-description").value='';}
    else{document.getElementById("wmsworkitems-description").value=desc;}
    if(typeof unit === "undefined"){document.getElementById("wmsworkitems-unit").value='';}
    else if(unit=="data-des="){document.getElementById("wmsworkitems-unit").value='';}
    else{document.getElementById("wmsworkitems-unit").value=unit;}
   
    $('#ItemModal').modal('hide');
}


function addItems(){
    var items_added = $("#wmsID").val();
    var wmsid = $("#wmsID").val();
    var itmeslist = $("#itmeslist").val();
    var description = $("#wmsworkitems-description").val();
    var remarks = $("#wmsworkitems-remarks").val();
    var number = $("#wmsworkitems-number1").val();
    var length = $("#wmsworkitems-length").val();
    var breadth = $("#wmsworkitems-breadth").val();
    var height = $("#wmsworkitems-height").val();
    var unit = $("#wmsworkitems-unit").val();
    var quantity = $("#wmsworkitems-quantity").val();
    var wmsid = $("#wmsID").val();
    var wmsid = $("#wmsID").val();
    var wmsid = $("#wmsID").val();

    $.ajax({
            url: "<?= Url::toRoute('/wms/add-items') ?>",
            type: "POST",
            data: { 
                items_added: items_added,
                wms_id: wmsid,
                item_id: itmeslist,
                description: description,
                remarks: remarks,
                number1: number,
                length: length,
                breadth: breadth,
                height: height,
                unit: unit,
                quantity: quantity,
                rate_type_id: wmsid,
                total_rate: wmsid,
                total_amount: wmsid,
            
             },
            success: function(response){
                  $('#itemtables').append(response);
            },
            error: function(){
                  // do action
            }
      });
}

function deductItems(){

    $.ajax({
            url: "<?= Url::toRoute('/wms/deduct-items') ?>",
            type: "POST",
            data: { itemid: itemid },
            success: function(response){
                  $('#ItemModal').modal('show');
                  $('#itemdiv').html(response);
            },
            error: function(){
                  // do action
            }
      });
    
}
</script>

<script>


function getquantity()
{
    var n = parseFloat(document.getElementById("wmsworkitems-number1").value);
    var x = parseFloat(document.getElementById("wmsworkitems-length").value);
    var y = parseFloat(document.getElementById("wmsworkitems-breadth").value);
    var z = parseFloat(document.getElementById("wmsworkitems-height").value);
    if(isNaN(x)){x='';}
    if(isNaN(y)){y='';}
    if(isNaN(z)){z='';}
    if(isNaN(n)){n='';}
    if(x>0){
        var q=x;
    }
    if(x>0 && y>0){
        var q=x * y;
    }
    if(z>0){
        var q=x * y * z;
    }
    
 
    document.getElementById("wmsworkitems-quantity").value = q*n;
    
    
}
</script>