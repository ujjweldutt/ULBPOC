<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BudgetProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Budget Proposals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-proposal-index">

    <h1>Proposal List</h1>

  
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'user_id',
            'budget.scheme.scheme',
            'ulb.name',
            'amount_demanded',
            'allocation_type',
            //'status',
            //'approved_by',
            //'uploaded_file',
            //'created_on',
            //'updated_on',

            [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{view}',
            'buttons' => [

                'view' => function ($url,$model) {
        
                    return Html::a(
        
                        '<span class="glyphicon glyphicon-eye-open"></span>', 
        
                        $url);
        
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='index.php?r=budget-proposal/approve&id='.$model->id;
                    return $url;
                }
            }
        
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
