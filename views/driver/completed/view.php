<link rel="stylesheet" href="../../public/CSS/cards/driver-delivery-card.css">
<link rel="stylesheet" href="../../public/CSS/popup/popup-styles.css">

<?php

/**
 * @var $deliveryModel \app\models\deliveryModel
 * @var $user \app\models\driverModel
 */

$CompletedDeliveries = $deliveryModel->getCompletedDeliveriesByDriverID($_SESSION['user']);

?>


<?php $profile = new \app\core\components\layout\profileDiv();

$profile->profile();

$profile->notification();

$profile->end(); ?>

<?php $headerDiv = new \app\core\components\layout\headerDiv(); ?>

<?php $headerDiv->heading("Completed Deliveries"); ?>

<?php $headerDiv->end(); ?>

<?php $searchDiv = new \app\core\components\layout\searchDiv();

$searchDiv->filterDivStart();

$searchDiv->filterBegin();

$filterForm = \app\core\components\form\form::begin('', '');
$filterForm->dropDownList($deliveryModel, "Select a Category", '', \app\models\donationModel::getAllSubcategories(), 'filterCategory');
$filterForm::end();

$searchDiv->filterEnd();

$searchDiv->sortBegin();

$sortForm = \app\core\components\form\form::begin('', '');
$sortForm->checkBox($deliveryModel,"Distance","",'sortDistance');
$sortForm->checkBox($deliveryModel, "Created Date", "", 'sortCreatedDate');
$sortForm->checkBox($deliveryModel, "Completed Date", "", 'sortCompletedDate');
$sortForm::end();

$searchDiv->sortEnd();

$searchDiv->filterDivEnd();

$searchDiv->end(); ?>

<div class="content">

    <div class="card-container" id="completedDeliveries">

        <?php

         \app\core\components\cards\driverDeliveryCard::showCompletedDeliveryCards($CompletedDeliveries);

         ?>

    </div>


</div>

<script type="module" src="../../public/JS/driver/completed/view.js"></script>
