<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="wms-view">

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
            //'id',
            'work_code_number',
            'user_id',
            'ulb_id',
            'ward_id',
            'scheme_id',
            'component_id',
            'financial_year_id',
            'work_name',
            'work_type',
            'work_sub_type',
            'work_scope',
            'announcement_type',
            'announcement_no',
            'announcement_date',
            'site_plan_file',
            'cross_section_file',
            'l_section_file',
            'google_map_file',
            'city_map_file',
            'is_active',
            'is_revised',
            'remarks',
            'created_on',
            'updated_on',
        ],
    ]) ?>

</div>
