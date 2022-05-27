<?php

include "models/Model.php";
include "models/Notification.php";
$notificationObj = new Notification();
if($_POST['type'] == 'delete') {
    $notificationObj->delete($_POST['id']);
}