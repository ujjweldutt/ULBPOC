<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorAssignWork */

$this->title = 'Create Vendor Assign Work';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Assign Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-assign-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
