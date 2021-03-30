<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VendorRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendor Registrations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vendor Registration', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'gst_no',
            'pan_no',
            //'tin_no',
            //'permanent_address:ntext',
            //'head_office_address1',
            //'head_office_address2',
            //'vendor_head_office_country_id',
            //'vendor_head_office_state_id',
            //'vendor_head_office_district_id',
            //'head_office_pin_code',
            //'head_office_telephone_no',
            //'head_office_mobile_no',
            //'head_office_company_url:url',
            //'head_office_business_established_year',
            //'branch_office_address1',
            //'branch_office_address2',
            //'vendor_branch_office_country_id',
            //'vendor_branch_office_state_id',
            //'vendor_branch_office_district_id',
            //'branch_office_pin_no',
            //'branch_office_telephone_no',
            //'branch_office_mobile_no',
            //'bank_name',
            //'bank_account_no',
            //'vendor_bank_account_type_id',
            //'ifsc_code',
            //'vendor_description:ntext',
            //'created_at',
            //'modified_at',
            //'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
