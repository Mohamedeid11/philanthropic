<!DOCTYPE html>
<?php
include('include/models.php');
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title> <?= trans('philanthropic')?> </title>
    <meta charset="UTF-8 ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/js/jqueryui/jquery-ui.min.css">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/css/animated.css">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/css/newcss.css">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/css/media.css">
    <link rel="stylesheet" href="assets_<?php echo $lang; ?>/css/footer-header.css">
</head>

<body <?php if($lang == 'ar') echo "dir='rtl'"; ?>>
