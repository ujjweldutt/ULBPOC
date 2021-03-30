<?php
use yii\bootstrap4\Nav;
?>

<?php
echo Nav::widget([
    'options' => ['class' => 'd-flex flex-column nav-pills  navbar-light'],
    'items' => [
        ['label' => 'Dashboard','url' => ['/site/index']],
      
        ['label' => 'Budget','url' => ['/budget/index']],
        ['label' => 'Budget Proposal','url' => ['/budget-proposal/index']],
        ['label' => 'Approve Proposal','url' => ['/budget-proposal/proposal']],
       // ['label' => 'User Roles', 'url' => ['role/index']],
        [ 'label' => 'Estimate Detail','url' => ['wms/index']],
        //['label' => 'Departments Roles', 'url' => ['departments-role/index']],
        ['label' => 'Estimate Create','url' => ['wms-work-items/index']],
		['label' => 'List of Estimate','url' => ['wms/estimate']],
        // ['label' => 'Service User Mapping','url' => ['service-mapping/index']],
        // ['label' => 'User Charges','url' => ['mst-user-role/index']],
        // ['label' => 'Manage Request','url' => ['user/requestlist']],
        // ['label' => 'Charge Approved List','url' => ['user/approvedlist']],
        // ['label' => 'Charge Rejected List','url' => ['user/rejectlist']],
        // ['label' => 'Charge Relinquish List','url' => ['user/relinquishlist']],
		['label' => 'Vendor Registration','url' => ['/vendor-registration/create']],
		['label' => 'Assign Work to Vendor','url' => ['/vendor-assign-work/create']],
		['label' => 'Vendor Items Rate','url' => ['/vendor-registration/vendor-items-rate']],
		['label' => 'Work and Vendor Rate Detail','url' => ['/vendor-registration/work-vendor-rate-detail']],
    ], 
]);
?>

