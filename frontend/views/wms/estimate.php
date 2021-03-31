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
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Project Estiate Calculate';
?>

<div class="wms-form">
<h1></h1>
   
    <div class="row">
        
        <div class="col-md-12">
        <h1>Work Code Number :   <?=$model->work_code_number?> </h1>
        <div class="row">
            <div class="col-md-4">
            <label class="control-label" >Work Number</label><br>
               <h5> <?=$model->work_code_number?> </h5>
            </div>
            <div class="col-md-4">
            <label class="control-label" >Work Name</label><br>
                <h5><?=$model->work_name?> </h5>
            </div>
            <div class="col-md-4">
            <label class="control-label" >Scheme</label><br>
              <h5> <?=$model->scheme->scheme?> </h5>  
            </div>
           
        </div>
        
      
         

        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Item Type</th>
                        <th>Item Number</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Numbers </th>
                        <th>Length</th>
                        <th>Breadth</th>
                        <th>Height</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                    <?php  
                     foreach($dataWmsWork as $key =>$val){?>

                    <tr>
                       <td><?=$val->item->item_name?></td>
                       <td><?=$val->item->item_no?></td>
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

                    <?php } ?>

                </tbody>
        </table>

        </div>
    </div>

   
    <div class="row">
      
  
        <div class="col-md-12">
        <h1>Abstract</h1>
        <hr></hr>
        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Basic Rate</th>
                        <th>Labour Rate</th>
                        <th>Material Rate</th>
                        <th>Machinery Rate</th>
                        <th>Through Rate</th>
                        <th>Rate Type</th>
                        <th>Actions</th>
                    </tr>
                    <?php  
                     foreach($dataWmsWork as $key =>$val){
                       
                         ?>
                        
                    <tr>
                         <td><?=$val->item->item_no?></td>
                       <td><?=$val->description?></td>
                       <td><?=$val->quantity?> </span></td>
                       <td><?=$val->unit?></td>
                       <td><?php  if($val->rate->id==1){ echo $val->rate->rate;} ?></td>
                       <td><?php if($val->rate->id==2){ echo $val->rate->rate;} ?></td>
                       <td><?php if($val->rate->id==3){ echo $val->rate->rate;} ?></td>
                       <td><?php if($val->rate->id==4){ echo $val->rate->rate;} ?></td>
                       <td><?php if($val->rate->id==5){ echo $val->rate->rate;} ?></td>
                       <td><?=$val->rate->rate_type?></td>
                    
                       <td><button type="button" class="btn btn-primary btn-sm" onclick="getcalculation(<?=$val->id?>,<?=$val->quantity?>,100)">Calculate</button></td>
                    </tr>

                    <?php } ?>

                </tbody>
        </table>
      
      
        </div>

        <div class="col-md-12">
        <h1>Calculated Abstract</h1>
        <hr></hr>
        <form method="POST" action="" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th> Rate</th>
                        <th>Rate Type</th>
                        <th>Amount</th> 
                        <th>Actions</th>
                    </tr>
                    <?php  
                     foreach($dataWmsWork as $key =>$val){
                       
                         ?>
                        
                    <tr>
                         <td><?=$val->item->item_no?></td>
                       <td><?=$val->description?></td>
                       <td><?=$val->quantity?> </span></td>
                       <td><?=$val->unit?></td>
                       <td><?php if($val->rate->id==1){ echo $val->rate->rate;} ?></td>
                       <td><?=$val->rate->rate_type?></td>
                     <td> <input type="hidden" name="workitemid[]"  value="<?=$val->id?>"  />
                    <input type="text" name="totalrate[<?=$val->id?>]" id="totalrate<?=$val->id?>" value=""  />
                   
                       </td> 
                     <td><input type="button" class="btn btn-warning"  value="Edit"  /> </td>
                    </tr>

                    <?php } ?>

                </tbody>
        </table>
      
      
        <br><br>
              <input type="submit" class="btn btn-success" name="save" />
        </form>
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
      <form method="POST" action="<?= Url::toRoute(['wms/update-estimate-details'])?>" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <h3>Are You sure want to delete this ?</h3>
            <input type="hidden" id="wms_itemid" name="wms_item_id"   /> 
     
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary" name="wmsitem_delete" >Delete</button>
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
      <form method="POST" action="<?= Url::toRoute(['wms/update-estimate-details'])?>" >
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
            <button class="btn btn-primary" name="wmsitem_update" >Update</button>
      </form> 
      </div>
      <div class="modal-footer">
     
     </div>
    </div>
  </div>
</div>

</div>

<script>
$(document).ready(function(){ 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?=Yii::$app->request->getCsrfToken();?>'
    }
    }); 


    $(document).on("click", ".modelblockdelete", function () {
        var id= $(this).attr('data-id');
    var url="<?= Url::toRoute(['wms/update-estimate-details'])?>";
    $("#DModal"+id).attr("href",url);
    $("#wms_itemid").val(id); 
    $.ajax({
        url: url,
            type: "GET",
            data: { id: id },
            success: function(response){
              
              
            },
            error: function(){
                  // do action
            }
      });

    });

    

$(document).on("click", ".modelblock1", function () {
    var id= $(this).attr('data-id');
    var url="<?= Url::toRoute(['wms/edit-estimate-details'])?>";
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


});  
function getcalculation(id,rate,quantity)
{
    var total=rate*quantity;
    document.getElementById("totalrate"+id).value=total;
   
    

} 


function getquantity()
{
    var n = parseFloat(document.getElementById("wmsworkitems-number1").value);
    var x = parseFloat(document.getElementById("length").value);
    var y = parseFloat(document.getElementById("breadth").value);
    var z = parseFloat(document.getElementById("height").value);
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
    
 
    document.getElementById("quantity").value = q*n;
    
    
}
</script>