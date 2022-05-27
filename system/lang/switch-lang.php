<?php
ob_start();
session_start();

$_SESSION['lang'] = $_SESSION['lang'] == 'en' ? 'ar' : 'en';

var_dump($_SESSION);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
