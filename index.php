<?php
// die('vendor need to upload');
defined('YII_DEBUG') or define('YII_DEBUG', true);
// defined('YII_ENV_TEST') or define('YII_ENV_TEST',true);
ini_set('memory_limit', '-1');
defined('YII_ENV') or define('YII_ENV', '');
date_default_timezone_set('Asia/Kolkata');
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/frontend/config/bootstrap.php';
//require __DIR__ . '/constants.php';


$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/frontend/config/main.php'
);
// echo "<pre>";print_r($config);die;
(new yii\web\Application($config))->run();
