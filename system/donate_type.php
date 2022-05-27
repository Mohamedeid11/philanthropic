<?php

include "models/Model.php";
include "models/DonateType.php";

$donate_typeObj = new DonateType();

if ($_POST['type'] == 'visible') {
    $donate_typeObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $donate_typeObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
}

