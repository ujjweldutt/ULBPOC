<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
 
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap h-100 d-flex flex-column">
    <?php echo $this->render('_header'); ?>
   
    <main class="d-flex">
        <div class="content-wrapper p-4">
            <?= $content ?>  
        </div>
    
    </main>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
