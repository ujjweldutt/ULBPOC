<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wms */

$this->title = 'Create Work';
$this->params['breadcrumbs'][] = ['label' => 'Work', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       
    ]) ?>

</div>
