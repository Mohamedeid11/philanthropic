<?ob_start(); ?>
<?php session_start(); ?>

<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $site_url = "http://localhost/Work/philanthropic/system/";
} else {
    $site_url = "http://bh-philanthropic.org/system/";
}
date_default_timezone_set('Asia/Bahrain');

$_SESSION['lang'] = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'ar';
$lang = $_SESSION['lang'];

include("connection.php");
include("functions/languages.php");
include("lang/" . $lang . ".php");
function trans($key)
{
    global $language;
    if (key_exists($key, $language)) {
        return $language[$key];
    } else {
        return '---';
    }
}
function old($key)
{
    if (key_exists($key, $_POST)) {
        return $_POST[$key];
    } else {
        return '';
    }
}
include("models/Model.php");
//include("functions/user_functions.php");
include("functions/categories_functions.php");
include("functions/client_functions.php");
include("functions/easyphpthumbnail.php");
include("functions/navigation_functions.php");


include("functions/other_details.php");

?>