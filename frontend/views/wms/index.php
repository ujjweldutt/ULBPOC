<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Wms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'work_code_number',
			'work_name',            
            'user_id',
            'ulb.name',
            //'ward_id',
            'scheme.scheme',
            //'component_id',
            //'financial_year_id',
            //'work_type',
            //'work_sub_type',
            //'work_scope',
            //'announcement_type',
            //'announcement_no',
            //'announcement_date',
            //'site_plan_file',
            //'cross_section_file',
            //'l_section_file',
            //'google_map_file',
            //'city_map_file',
            //'is_active',
            //'is_revised',
            //'remarks',
            //'created_on',
            //'updated_on',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['wms-work-items/create', 'id' => $model->id]);
                    }
                }
        
           ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
