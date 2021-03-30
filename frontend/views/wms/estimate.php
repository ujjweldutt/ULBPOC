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

$this->title = 'Work Details';
?>

<div class="wms-form">
<h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">


            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Work Code</th>
                        <th>Work Name</th>
                        <th>Work Type</th>
                        <th>Work Created Date</th>
                        <th>MC Name</th>
                        <th>Quality of work</th>
                        <th>Financial Year</th>
                    </tr>
                    <tr>
                        <td><?=$model->work_code_number?></td>
                        <td><?=$model->work_name?></td>
                        <td><?=$model->work_type?></td>
                        <td><?=$model->created_on?></td>
                        <td><?=$model->ulb->name?></td>
                        <td><?=$model->work_scope?></td>
                        <td><?=$model->financialYear->financial_year?></td>
                    </tr>
                
                </tbody>
            
            </table>
         </div>
        <div class="col-md-6">

        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Scheme Name</th>
                        <th>Scheme Component Name</th>
                        <th>Total Amount (Rs) </th>
                        <th>Announcement Date</th>
                        <th>Announcement Type</th>
                        <th>Announcement No</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td><?=$model->scheme->scheme?></td>
                        <td><?=$model->component->component?></td>
                        <td></td>
                        <td><?=$model->announcement_date?> </td>
                        <td><?=$model->announcement_type?></td>
                        <td><?=$model->announcement_no?></td>
                        <td>Pending</td>
                       
                    </tr>
                
                </tbody>
            
            </table>
           
         </div>
     
    </div>

    <div class="row">
        
        <div class="col-md-12">
        <h1>Work Items</h1>

        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Item</th>
                        <th>Remarks</th>
                        <th colspan="3">Numbers </th>
                        <th>Length</th>
                        <th>Breadth</th>
                        <th>Height</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Item Type</th>
                        <th>Actions</th>
                    </tr>
                    <?php  
                     foreach($dataWmsWork as $key =>$val){?>

                    <tr>
                       <td><?=$val->item->item_name?></td>
                       <td><?=$val->remarks?></td>
                       <td><?=$val->number1?></td>
                       <td><?=$val->number2?></td>
                       <td><?=$val->number3?></td>
                       <td><?=$val->length?></td>
                       <td><?=$val->breadth?></td>
                       <td><?=$val->height?></td>
                       <td><?=$val->unit?></td>
                       <td><?=$val->quantity?></td>
                       <td></td>
                       <td><button class="btn btn-warning btn-sm">Edit</button></td>
                    </tr>

                    <?php } ?>

                </tbody>
        </table>

        </div>
    </div>

   
    <div class="row">
        <form method="POST" action="" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
  
        <div class="col-md-12">
        <h1>Abstract</h1>

        <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Labour Rate</th>
                        <th>Through Rate</th>
                        <th>Premium Labour Rate</th>
                        <th>Labour Through Rate</th>
                        <th>Rate Type</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                    <?php  
                     foreach($dataWmsWork as $key =>$val){
                       
                         ?>
                        
                    <tr>
                       <td>
                       
                       <?=$val->item->item_code?>
                      
                       </td>
                       <td><?=$val->description?></td>
                       <td><?=$val->quantity?> </span></td>
                       <td><?=$val->unit?></td>
                       <td>100</td>
                       <td></td>
                       <td>100</td>
                       <td></td>
                       <td>
                       <select class="form-control" id="rate_type">
                             <?php  
                            foreach($ratetypedata as $key =>$rval){?>
                            <option value=""> --Please Select --</option>
                             <option value="<?=$rval->id?>"><?=$rval->rate_type?></option>
                            <?php } ?>
                       </select>
                       </td>
                       <td>
                       <input type="hidden" name="workitemid[]"  value="<?=$val->id?>"  />
                       <input type="text" name="totalrate[<?=$val->id?>]" id="totalrate<?=$val->id?>" value="" readonly />
                       </td>
                       <td><button type="button" class="btn btn-primary btn-sm" onclick="getcalculation(<?=$val->id?>,<?=$val->quantity?>,100)">Calculate</button></td>
                    </tr>

                    <?php } ?>

                </tbody>
        </table>
      
      
        <br><br>
              <input type="submit" class="btn btn-sm btn-success" name="save" />
        </form>
        </div>
    </div>


  
</div>

<script>
function getcalculation(id,rate,quantity)
{
    var total=rate*quantity;
    document.getElementById("totalrate"+id).value=total;
    

}
</script>