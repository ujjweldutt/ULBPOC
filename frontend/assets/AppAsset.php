<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/center.css',
        'css/dataTables.bootstrap4.min.css',
        'css/main.css',
        
    ];
    public $js = [
   // 'js/jquery-1.10.2.js',
    'js/bootstrap.bundle.min.js',
   // 'js/dataTables.bootstrap4.min.js',
    'js/all.min.js',
    'js/jquery.dataTables.min.js',
  //  'js/jquery-3.5.1.slim.min.js',
    'js/jquery-ui.js',
    'js/scripts.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
	public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
