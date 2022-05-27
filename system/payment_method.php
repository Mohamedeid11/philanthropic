<?php

include "models/Model.php";
include "models/PaymentMethod.php";

$payment_methodObj = new PaymentMethod();

if ($_POST['type'] == 'visible') {
    $payment_methodObj->update([
        'id' => $_POST['id'],
        'display' => '1'
    ]);
} elseif ($_POST['type'] == 'hidden') {
    $payment_methodObj->update([
        'id' => $_POST['id'],
        'display' => '0'
    ]);
}

