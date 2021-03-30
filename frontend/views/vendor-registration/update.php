<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorRegistration */

$this->title = 'Update Vendor Registration: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
