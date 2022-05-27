<?php

include "models/Model.php";
include "models/Message.php";

$messageObj = new Message();
if($_POST['type'] == 'delete') {
    $messageObj->delete($_POST['id']);
}


