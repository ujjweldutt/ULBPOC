<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of Estimate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-index">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table">
    <tbody>
        <tr>
            <th>MC Name</th>
            <th>Work code</th>
            <th>Work Name</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Status</th>
            <th>Is Revised</th>
            <th>Is Active</th>
            <th>Action</th>
        </tr>
        <?php foreach( $dataProvider as $key =>$val){?>

            <tr>
            <td><?=$val->ulb->name?></td>
            <td><?=$val->work_code_number?></td>
            <td><?=$val->work_name?></td>
            <td><?=$val->user_id?></td>
            <td><?=$val->created_on?></td>
            <td>Submitted but not send for Approval</td>
            <td><input type="checkbox" name="is_revised" <?php if($val->is_revised>0){echo 'checked';}?> ></td>
            <td><input type="checkbox" name="is_active"  <?php if($val->is_active>0){echo 'checked';}?>></td>
            <td>
                <a href="index.php?r=wms/estimate-details&id=<?=$val->id?>" >
                    <button  type="button" class="btn btn-sm btn-primary"  > Details </button> 
                </a>
            
            </td>
        </tr>
        <?php }?>
       

    </tbody>
    
    </table>
   
</div>
