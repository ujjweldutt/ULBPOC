<?php
use yii\bootstrap4\Nav;
?>
<aside class="shadow">
<?php
echo Nav::widget([
    'options' => ['class' => 'd-flex flex-column nav-pills  navbar-light'],
    'items' => [
        ['label' => 'Dashboard','url' => ['/site/index']],
      
        ['label' => 'Budget','url' => ['/budget/index']],
        ['label' => 'Budget Proposal','url' => ['/budget-proposal/index']],
        ['label' => 'Approve Proposal','url' => ['/budget-proposal/approve']],
       // ['label' => 'User Roles', 'url' => ['role/index']],
        [ 'label' => 'Estimate Detail','url' => ['wms/index']],
        //['label' => 'Departments Roles', 'url' => ['departments-role/index']],
        ['label' => 'Estimate Create','url' => ['wms-work-items/index']],
        // ['label' => 'Service User Mapping','url' => ['service-mapping/index']],
        // ['label' => 'User Charges','url' => ['mst-user-role/index']],
        // ['label' => 'Manage Request','url' => ['user/requestlist']],
        // ['label' => 'Charge Approved List','url' => ['user/approvedlist']],
        // ['label' => 'Charge Rejected List','url' => ['user/rejectlist']],
        // ['label' => 'Charge Relinquish List','url' => ['user/relinquishlist']],
    ], 
]);
?>
</aside>
