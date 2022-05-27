<?php

include "models/Model.php";
include "models/CommonQuestions.php";

$common_questionObj = new CommonQuestions();

if ($_POST['type'] == 'visible') {
    $common_questionObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $common_questionObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
} elseif($_POST['type'] == 'delete') {
    $common_questionObj->delete($_POST['id']);
}

