<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VendorAssignWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendor Assign Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-assign-work-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vendor Assign Work', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vendor_registration_id',
            'reference_no',
            'agency_period_months',
            'agency_tendor_no',
            //'estimated_amount',
            //'work_start_date',
            //'work_completion_date',
            //'liability_period_days',
            //'brief_work_details',
            //'note_other_conditions',
            //'security_deposit',
            //'earnest_money_deposit',
            //'created_at',
            //'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
