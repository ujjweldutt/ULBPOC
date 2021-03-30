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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Budget Proposal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'budget_id',
            'ulb_id',
            'amount_demanded',
            //'allocation_type',
            //'status',
            //'approved_by',
            //'uploaded_file',
            //'created_on',
            //'updated_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
