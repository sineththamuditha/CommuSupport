<?php

namespace app\core\components\layout;

use app\core\Application;
use app\models\notificationModel;

class profileDiv
{
    private array $notifications = [];
    private array $processByuserType = [
        'logistic' => ['donation','employee'],
        'manager' => ['donation', 'request','employee'],
        'driver' => ['delivery','employee'],
        'cho' => ['complain','employee'],
        'donee' => ['request','user','event'],
        'donor' => ['donation','user','event'],
    ];

    public function __construct()
    {

        echo "<div class='profile'>";
        $this->notifications = notificationModel::getNotification(['userID' => $_SESSION['user'], 'usertype' =>  $_SESSION['userType'], 'related' => $this->processByuserType[$_SESSION['userType']]]);
//        echo "<pre>";
//        print_r($this->notifications);
//        echo "</pre>";
    }

    public function notification(): void
    {
        echo "<div class='notif-box'>";
        echo "<a href='#' id='notification'><i class='material-icons'>notifications</i></a>";
        echo "</div>";
    }

    public function profile(): void
    {
        echo sprintf("<a class='profile-box' href='/CommuSupport/%s/profile'>", $_SESSION['userType']);
        echo "<div class='name-box'>";
        echo sprintf("<h4>%s</h4>",$this->getUsername());
        echo sprintf("<p>%s</p>", $this->getPosition());
        echo "</div>";
        echo "<div class='profile-img'>";
        echo "<img src='https://www.w3schools.com/howto/img_avatar.png' alt='profile'>";
        echo "</div>";
//        echo "</div>";
        echo "</a>";
    }

    public function end(): void
    {
        echo "</div>";
    }

    private function getUsername(): string
    {
        return Application::session()->get('username');
    }

    private function getPosition(): string
    {
        switch(Application::session()->get('userType')){
            case 'donor':
                return 'Donor';
            case 'donee':
                return 'Donee';
            case 'manager':
                return 'Manager';
                case 'logistic':
                return 'Logistic';
            case 'cho':
                return 'CHO';
                case 'admin':
                return 'Admin';

            default:
                return 'User';
        }
    }
}