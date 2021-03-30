<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */

$this->title = 'Create Wms';
$this->params['breadcrumbs'][] = ['label' => 'Wms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
