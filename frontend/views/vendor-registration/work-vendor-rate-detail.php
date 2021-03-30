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

$this->title = 'Work and Vendor Rate Detial';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
      <th scope="col" width=10%>Vendor Name</th>
      <th scope="col" width=10%>Work Name</th>
      <th scope="col" width=7%>Item Code</th>
      <th scope="col" width=23%>Item Description</th>
      <th scope="col" width=5%>U.O.M</th>
      <th scope="col" width=5%>Quantity</th>
      <th scope="col" width=10%>Estimated Rate(Rs.)</th>
      <th scope="col" width=10%>Item Rate(Rs.)</th>
      <th scope="col" width=5%>% Rate</th>
      <th scope="col" width=10%>Calculated Rate by vendor(Rs.)</th>
      <th scope="col" width=5%>Amount(Rs.)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">Pankaj</td>
      <td>UKHLANA WMS Work</td>
      <td>6.b.iv.3</td>
      <td>6.12.-Extra over and above item no. 6.11 for driven/piled type timbering, required in running sandy strata for every 2 meters depth, or part thereof.</td>
      <td>mtr</td>
      <td>144.00</td>
      <td>84.60</td>
      <td>82.00</td>
      <td>NA</td>
      <td>82.00</td>
      <td>11808.00</td>
    </tr>
	<tr>
      <td scope="row">Pankaj</td>
      <td>UKHLANA WMS Work</td>
      <td>4.1.a</td>
      <td>4.1.(a)-Stone(building or pitching), sand, bajri, shingle, spalls, bricks-bats, brick ballast and stone metal loading into wagons.</td>
      <td>cum</td>
      <td>45.00</td>
      <td>16.50</td>
      <td>14.00</td>
      <td>NA</td>
      <td>14.00</td>
      <td>630.00</td>
    </tr>
  </tbody>
</table>
<?php
	ActiveForm::end();
?>
</div>
