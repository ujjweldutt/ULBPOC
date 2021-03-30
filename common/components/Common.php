<?php
namespace common\components;
use Yii;
use yii\helpers\Html;
class Common 
{
	public static function transarray($array) { 
		foreach ($array as $key => $value) {
			$array[$key] = Yii::t('app', $value);
		} 
		return $array; 
	}
}
?>