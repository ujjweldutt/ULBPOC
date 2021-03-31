<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<?php $this->beginBody() ?>

    <div class="content-wrapper col-md-12">
        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget() ?>
            </div>
        </div>

        <?= $content ?> 

    </div>

<?php $this->endBody() ?>
</body>

<?php $this->endPage() ?>