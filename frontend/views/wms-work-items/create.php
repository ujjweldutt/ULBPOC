<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\WmsWorkItems */

$this->title = 'Work Estimate';
$this->params['breadcrumbs'][] = ['label' => 'Work Estimate', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-work-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'wmsmodel' => $wmsmodel,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'dataWmsWork' => $dataWmsWork,
    ]) ?>

</div>
