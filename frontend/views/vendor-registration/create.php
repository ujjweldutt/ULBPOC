<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VendorRegistration */

$this->title = 'Create Vendor Registration';
$this->params['breadcrumbs'][] = ['label' => 'Vendor Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-registration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
