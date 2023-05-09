<link rel="stylesheet" href="../public/CSS/profile/profile.css">

<?php

/**
 *@var $driver driverModel
 */

use app\models\driverModel;

[ $personalInfo, $driverStat ] =  $driver->getDriverInformationForProfile();


//echo '<pre>';
//var_dump($doneeInfo['doneeStat']);
//echo '</pre>';

?>

<div class="profile-container">
    <div class="profile">

        <div class="edit-change-password">
            <p id="change-password"> Change Password </p>
            <i class="material-icons" id="edit-details">edit_note</i>
        </div>

        <div class="img-username-div">

            <div class="profile-img">
            </div>
            <h1><?php echo $personalInfo['name'] ?></h1>
            <p class="user-type"><?php echo '@' . $personalInfo['username'] ?></p>
        </div>

        <!--        each attribute is displayed as disabled input field-->
        <!--        provide an id for the fields that can be updated-->
        <form action="#" class="form-grid-1">

            <div class="personal-details">

                <div class="form-group">
                    <label class="form-label"> Name </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['name'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label"> NIC </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['NIC'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label"> Age </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['age'] ?>" disabled>
                </div>


                <div class="form-group">
                    <label class="form-label"> Contact Number </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['contactNumber'] ?>" disabled>
                </div>

            </div>

            <div class="form-group description">
                <label class="form-label"> Address </label>
                <textarea class="basic-text-area"  disabled> <?php echo $personalInfo['address'] ?> </textarea>
            </div>



            <div class="personal-details">

                <div class="form-group">
                    <label class="form-label"> Community Center </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['city'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label"> District </label>
                    <input class="basic-input-field" value="<?php echo $personalInfo['district'] ?>" disabled>
                </div>

            </div>


        </form>

    </div>

    <!--    display each stat and a block-->
    <div class="stats display-grid columns-3 rows-2">

        <?php foreach ($driverStat as $key => $value) {

            // stat and the value
            echo "<div class='stat'>";
            echo "<h4 class='align-text-center'>{$key}</h4>";
            echo "<h1 class='align-text-center'>{$value}</h1>";
            echo "</div>";

        }?>

    </div>
    <div class="profile-notifications">

        <div class="profile-notif-container-">

            <?php

            $notificationIcon = [
                'event' => 'event',
                'directDonations' => 'local_shipping',
                'request' => 'local_shipping',
                'acceptedRequests' => 'local_shipping',
                'delivery' => 'local_shipping',
                'ccDonation' => 'local_shipping',
                'complaint' => 'report'
            ];

            $notifications = \app\models\notificationModel::getNotification(['userID' => $_SESSION['user'], 'usertype' =>  $_SESSION['userType']]);

            foreach ($notifications as $notification) {

                echo "<div class='profile-notif-card'>";
                echo "<div class='profile-notif-left-block'>";

                // title and the message
                echo "<div class='profile-notif-message'>";
                echo sprintf("<h4> %s </h4>",$notification['title']);
                echo sprintf("<p><small>%s</small></p>",$notification['message']);
                echo "</div>";

                // date and time
                echo "<div class='profile-notif-date-time'>";
                echo sprintf("<p class='date'>%s</p>",date('M d',strtotime($notification['dateCreated'])));
                echo sprintf("<p class='time'>%s</p>",date('g:i a',strtotime($notification['dateCreated'])));
                echo "</div>";

                echo "</div>";

                echo "<div class='profile-notif-right-block'>";

                // icon for related process
                echo    sprintf("<i class='material-icons'>%s</i>", $notificationIcon[$notification['related']]);

                echo "</div>";

                echo "</div>";

            }

            ?>

        </div>


    </div>
</div>