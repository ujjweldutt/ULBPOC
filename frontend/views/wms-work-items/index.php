<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WmsWorkItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wms Work Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-work-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Wms Work Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'wms_id',
            'item_id',
            'description',
            'remarks',
            //'number1',
            //'number2',
            //'number3',
            //'length',
            //'breadth',
            //'height',
            //'unit',
            //'quantity',
            //'rate_type_id',
            //'total_rate',
            //'total_amount',
            //'status',
            //'created_on',
            //'updated_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
