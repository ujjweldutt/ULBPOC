<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VendorRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendor Items Rate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Work Name:- UKHLANA WMS Work', ['create'], ['class' => 'btn btn-success disabled']) ?>
    </p>
	<?php
		$form = ActiveForm::begin([
		'id' => 'active-form',
		'options' => [
			'class' => 'form-horizontal',
			'enctype' => 'multipart/form-data'
		],
	]);
	?>
    <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col" width=5%>Item ID</th>
      <th scope="col" width=7%>Item Code</th>
      <th scope="col" width=23%>Item Description</th>
      <th scope="col" width=5%>U.O.M</th>
      <th scope="col" width=10%>Estimated Quantity</th>
      <th scope="col" width=10%>Applied Rate Type</th>
      <th scope="col" width=5%>Rate(Rs.)</th>
      <th scope="col" width=10%>Choose Type</th>
      <th scope="col" width=10%>Item Rate</th>
      <th scope="col" width=10%>% Rate</th>
      <th scope="col" width=5%></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">282</th>
      <td>4.1.a</td>
      <td>4.1.(a)-Stone(building or pitching), sand, bajri, shingle, spalls, bricks-bats, brick ballast and stone metal loading into wagons.</td>
      <td>cum</td>
      <td>45.00</td>
      <td>Labour Rate</td>
      <td>16.50</td>
      <td>
		<?php //Html::radio('agree', '', ['label' => 'I agree']) ?>
		<?php //Html::radio('agree1', '', ['label' => 'I agree1']) ?>
		<?php
			$new = [1 => 'Item Rate', 2 => '% Rate'];
			echo Html::radioList('rate', null, $new, [
				'class' => '',
				'itemOptions' => ['class' => 'radio'],
			]);
		?>
	  </td>
      <td>
		<?= Html::textInput('item_rate', '', ['class' => 'form-control', 'placeholder' => 'Enter Rate']) ?>
	  </td>
      <td>
		<?= Html::textInput('per_rate', '', ['class' => 'form-control', 'placeholder' => 'Enter % Rate']) ?>
	  </td>
      <td>
		<?= Html::a('Calculate', '', ['class' => 'btn btn-warning']) ?>
	  </td>
    </tr>
	<tr>
      <th scope="row">515</th>
      <td>6.b.iv.3</td>
      <td>6.12.-Extra over and above item no. 6.11 for driven/piled type timbering, required in running sandy strata for every 2 meters depth, or part thereof.</td>
      <td>mtr</td>
      <td>144.00</td>
      <td>Labour Rate</td>
      <td>84.60</td>
      <td>
		<?php //Html::radio('agree', '', ['label' => 'I agree']) ?>
		<?php //Html::radio('agree1', '', ['label' => 'I agree1']) ?>
		<?php
			$new = [1 => 'Item Rate', 2 => '% Rate'];
			echo Html::radioList('rate1', null, $new, [
				'class' => '',
				'itemOptions' => ['class' => 'radio'],
			]);
		?>
	  </td>
      <td>
		<?= Html::textInput('item_rate1', '', ['class' => 'form-control', 'placeholder' => 'Enter Rate']) ?>
	  </td>
      <td>
		<?= Html::textInput('per_rate1', '', ['class' => 'form-control', 'placeholder' => 'Enter % Rate']) ?>
	  </td>
      <td>
		<?= Html::a('Calculate1', '', ['class' => 'btn btn-warning']) ?>
	  </td>
    </tr>
  </tbody>
</table>
<?php
	ActiveForm::end();
?>
</div>
