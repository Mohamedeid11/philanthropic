<?php

include "models/Model.php";
include "models/Cart.php";

$cartObj = new Cart();

//if ($_POST['type'] == 'visible') {
//    $cartObj->update([
//        'id' => $_POST['id'],
//        'display' => '1'
//    ]);
//} elseif ($_POST['type'] == 'hidden') {
//    $cartObj->update([
//        'id' => $_POST['id'],
//        'display' => '0'
//    ]);
//} elseif($_POST['type'] == 'delete') {
//
//    $cartObj->delete($_POST['id']);
//}

if (isset($_POST['delete'])) {

    $cartObj->delete($_POST['delete']);
}


