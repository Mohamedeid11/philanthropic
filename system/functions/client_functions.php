<?php


function add_client($name, $phone, $email, $password) {

    global $con;
    $insert = $con->query("INSERT INTO `clients`(`name`,`password`,`mobile`,`email`) VALUES ('$name','$password','$phone','$email')");
    return mysqli_insert_id($insert);
}

function client_exists($clientEmail) {

    global $con;

    $query = $con->query("SELECT 1 FROM `clients` WHERE `client_email`='$clientEmail' LIMIT 1");

    return (mysqli_num_rows($query) == 1) ? true : false;
}

function get_client_by_id($client_id) {

    global $con;

    $query = $con->query("SELECT * FROM `clients` WHERE `client_id`='$client_id' LIMIT 1");
    $row= mysqli_fetch_array($query);

    return $row;
}

function getClientId($client_id) {

    global $con;

    $query = $con->query("SELECT * FROM `clients` WHERE `client_id`='$client_id' LIMIT 1");
    $row_select = mysqli_fetch_array($query);

    $client_email = $row_select['email'];
    return $client_email;
}


function clientName($client_id) {
    global $con;
    $query_select = $con->query("SELECT * FROM `clients` WHERE `client_id`='" . $client_id . "' ORDER BY `client_id` LIMIT 1 ");
    $row_select = mysqli_fetch_array($query_select);
    $client_name = $row_select['name'];
    return $client_name;
}

function clientPhone($client_id) {
    global $con;
    $query_select = $con->query("SELECT * FROM `clients` WHERE `client_id`='" . $client_id . "' ORDER BY `client_id` LIMIT 1 ");
    $row_select = mysqli_fetch_array($query_select);
    $clientPhone = $row_select['phone'];
    return $clientPhone;
}

function clients_count($get) {

    global $con;
    $sql = " SELECT * FROM `clients` ORDER BY `client_id` DESC ";

    $query = $con->query($sql);

    $clients_count = mysqli_num_rows($query);

    return $clients_count;
}

// View Sub Category Table
function view_client($aStart = 0, $aLimit = 0, $get) {

    global $con;
    $clients = array();

    $sql = " SELECT * FROM `clients` ORDER BY `client_id` DESC ";
    

    $sql.= $aLimit ? "LIMIT {$aStart},{$aLimit}" : "";
    $query_select = $con->query($sql);
    $x = 1;
    while ($row = mysqli_fetch_assoc($query_select)) {
        array_push($clients, $row);

        $x++;
    }
    return $clients;
}


if (isset($_POST['verify'])) {

    include("../connection.php");

    $verify = $_POST['verify'];

    $query = $con->query("UPDATE `clients` SET `verify`=1 WHERE `client_id`='$verify'");

    if ($query) {
// echo get_success("تم التفعيل بنجاح");
    }
}

if (isset($_POST['cancel_verify'])) {

    include("../connection.php");

    $cancel_verify = $_POST['cancel_verify'];

    $query = $con->query("UPDATE `clients` SET `verify`=0 WHERE `client_id`='$cancel_verify'");

    if ($query) {
// echo get_success("تم إلغاء التفعيل بنجاح");
    }
}

if (isset($_POST['client'])) {

    include("../connection.php");

    $client = $_POST['client'];
    $querya = $con->query("SELECT * FROM `clients` WHERE `client_id`='$client' limit 1");
    $row_select = mysqli_fetch_array($querya);
    $client_image = $row_select['client_image'];
    $mostafa = explode('/', $client_image);
    $image_name = $mostafa[7];
    $full_img_path = dirname(__FILE__) . "/../../app/api/uploads/clients/{$image_name}";
    if (file_exists($full_img_path)) {
        @unlink($full_img_path);
    }
    $query = $con->query("DELETE FROM `clients` WHERE `client_id`='$client'");

    if ($query) {
        echo get_success("تم الحذف بنجاح");
    }
}

function client_count() {

    global $con;

    $query = $con->query("SELECT * FROM `clients` ORDER BY `client_id` ASC");

    $client_count = mysqli_num_rows($query);

    return $client_count;
}
?>