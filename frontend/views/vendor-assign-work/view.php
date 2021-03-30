<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorAssignWork */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Assign Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-assign-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vendor_registration_id',
            'reference_no',
            'agency_period_months',
            'agency_tendor_no',
            'estimated_amount',
            'work_start_date',
            'work_completion_date',
            'liability_period_days',
            'brief_work_details',
            'note_other_conditions',
            'security_deposit',
            'earnest_money_deposit',
            'created_at',
            'is_active',
        ],
    ]) ?>

</div>
