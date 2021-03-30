<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorAssignWork */

$this->title = 'Update Vendor Assign Work: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Assign Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-assign-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
