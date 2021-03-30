<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\WmsWorkItems */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wms Work Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="wms-work-items-view">

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
            'wms_id',
            'item_id',
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
            'rate_type_id',
            'total_rate',
            'total_amount',
            'status',
            'created_on',
            'updated_on',
        ],
    ]) ?>

</div>
