<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
 
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <style>
        .fade {
            opacity: 1 !important;
        }
    </style>
</head>
<?php $this->beginBody() ?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-light">
    <a class="navbar-brand" href="#">
        <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/uk_MCD_Logo.png" alt="LOGO">
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <form>
                <select class="btnlang">
                    <option>English</option>
                    <option>Hindi</option>
                    <option>English</option>
                </select>
            </form>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_header_profile_icon.svg" alt=""></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Logout</a>
            </div>
        </li>
        <li class="nav-item">
            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/Uttarakhand_Flag.png" alt="">
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-2 mr-2">
                    <div class="input-group mt-4">
                        <input class="form-control" type="text" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="nav mt-5">
                    <a class="nav-link current" href="<?= Url::toRoute('/budget/index'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_PropertyTax_hl.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_PropertyTax.svg" alt="#" class="hoverimage">
                        </div>
                        Budget
                    </a>
                    <a class="nav-link" href="<?= Url::toRoute('/budget-proposal/index'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_BuildingPlanApproval.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_BuildingPlanApproval_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Fund Allocation
                    </a>
                    <a class="nav-link" href="<?= Url::toRoute('/budget-proposal/proposal'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_FireNOC.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_FireNOC_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Fund Allocation Approve
                    </a>
                   <!-- <a class="nav-link" href="<?php // Url::toRoute('wms-work-items/index'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?php // Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence.svg" alt="#" class="beforeimage">
                            <img src="<?php // Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Estimate Create
                    </a>-->
                   
                    <a class="nav-link" href="<?= Url::toRoute('wms/index'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_WaterSewerage.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_WaterSewerage_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Work Details
                    </a>

                    <a class="nav-link" href="<?= Url::toRoute('wms/estimate'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_WaterSewerage.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_WaterSewerage_hl.svg" alt="#" class="hoverimage">
                        </div>
                        List of Estimate
                    </a>


                    <a class="nav-link" href="<?= Url::toRoute('/vendor-registration/create'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Vendor Registration
                    </a>
                    <a class="nav-link" href="<?= Url::toRoute('/vendor-assign-work/create'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Assign Work to Vendor
                    </a>
                    <a class="nav-link" href="<?= Url::toRoute('/vendor-registration/vendor-items-rate'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Vendor Items Rate
                    </a>
                    <a class="nav-link" href="<?= Url::toRoute('/vendor-registration/work-vendor-rate-detail'); ?>">
                        <div class="sb-nav-link-icon">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence.svg" alt="#" class="beforeimage">
                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/ic_TradeLicence_hl.svg" alt="#" class="hoverimage">
                        </div>
                        Work and Vendor Rate Detail
                    </a>

                </div>
            </div>
        </nav>
    </div>
<body>
<?php $this->beginBody() ?>

<div class="wrap h-100 d-flex flex-column">
    <?php echo $this->render('_header'); ?>
   
    <main class="d-flex">
    <?php echo $this->render('_sidebar'); ?>
        <div class="content-wrapper p-4">
            <div class="row">
                <div class="col-md-12">
                  <?= Alert::widget() ?>
                </div>
            </div>
            <?= $content ?>  
        </div>
    
    </main>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
