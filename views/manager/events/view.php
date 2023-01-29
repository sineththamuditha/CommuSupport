<link rel="stylesheet" href="/CommuSupport/public/CSS/cards/eventcard.css">
<?php

/** @var $model \app\models\eventModel */

use app\core\Application;

$managerID = Application::$app->session->get('user');
$manager = new \app\models\managerModel();
$manager = $manager->findOne(['employeeID' => $managerID]);
$ccID = $manager->ccID;

$events = $model->retrieve(["ccID" => $ccID],["date", "DESC"]);
?>

<!--profile div-->

<!--<div class="profile">-->
<!--    <div class="notif-box">-->
<!--        <i class="material-icons">notifications</i>-->
<!--    </div>-->
<!--    <div class="profile-box">-->
<!--        <div class="name-box">-->
<!--            <h4>Username</h4>-->
<!--            <p>Position</p>-->
<!--        </div>-->
<!--        <div class="profile-img">-->
<!--            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="profile">-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php
$eventCards = new \app\core\components\cards\eventcard();
$eventCards->displayEvents($events);

?>

<?php $creatEvent = \app\core\components\form\form::begin('./events/create', 'get'); ?>

<button> Create event </button>

<?php $creatEvent->end(); ?>

<div>
    <?php $filter = \app\core\components\form\form::begin('', ''); ?>

    <?php $filter->dropDownList($model,"Event Type","eventCategory",$model->getEventCategories(),"eventCategory")?>

    <label for="sameCC">Same CC</label>
    <input type="checkbox" id="sameCC" value="<?php echo $manager->ccID ?>">

    <button type="button" id="filterBtn">Filter</button>

    <?php $filter->end(); ?>
</div>

<div id="popUpBackground" style="display: none">

    <div id="popUpContainer">

    </div>

</div>

<script type="module" src="/CommuSupport/public/JS/manager/events/view.js"></script>
