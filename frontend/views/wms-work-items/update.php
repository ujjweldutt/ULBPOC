<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\WmsWorkItems */

$this->title = 'Update Wms Work Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wms Work Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wms-work-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'wmsmodel' => $wmsmodel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
