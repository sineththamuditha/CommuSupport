<link rel="stylesheet" href="../public/CSS/button/button-styles.css">
<link rel="stylesheet" href="../public/CSS/cards/cc-card.css">
<?php

/** @var $model \app\models\ccModel */
/** @var $user \app\models\donorModel */



$CCs = $model->retrieve();

?>

<?php $profile = new \app\core\components\layout\profileDiv();

$profile->profile();

$profile->notification();

$profile->end(); ?>

<!--   Heading Block - Other Pages for Ongoing, Completed .etc      -->
<?php
$headerDiv = new \app\core\components\layout\headerDiv();

$headerDiv->heading("Community Centers");

$headerDiv->end();
?>

<?php
$checkVerification = new \app\core\components\layout\verificationDiv();

if($checkVerification->notVerified()) {
    return;
}
?>


<!--        Search and filter boxes -->
<?php
$searchDiv = new \app\core\components\layout\searchDiv();

$searchDiv->filterDivStart();

$searchDiv->filterBegin();

    $filter = \app\core\components\form\form::begin('', '');
    $filter->dropDownList($model,"District","cho",\app\models\choModel::getCHOs(),"district");
    $filter->end();

$searchDiv->filterEnd();

$searchDiv->filterDivEnd();

$searchDiv->end();
?>

<div class="content card-container">

    <?php $ccCard = new \app\core\components\cards\CCcard(); ?>

    <?php $ccCard->displayCCs($CCs); ?>

</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv492o7hlT-nKoy2WGWmnceYZLSw2UDWw&callback=initMap" async defer></script>
<script type="module" src="../public/JS/donor/CC/view.js"></script>

