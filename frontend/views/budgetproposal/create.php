<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BudgetProposal */

$this->title = 'Create Budget Proposal';
$this->params['breadcrumbs'][] = ['label' => 'Budget Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-proposal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
