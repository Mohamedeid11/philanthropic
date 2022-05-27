<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets_<?php echo $lang; ?>/images/favicon_1.ico">

        <title><?php echo trans('philanthropic'); ?></title>
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets_<?php echo $lang; ?>/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
        <link href="assets_<?php echo $lang; ?>/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
        <link href="assets_<?php echo $lang; ?>/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- Plugins css -->
        <link href="assets_<?php echo $lang; ?>/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets_<?php echo $lang; ?>/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="assets_<?php echo $lang; ?>/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="assets_<?php echo $lang; ?>/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets_<?php echo $lang; ?>/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets_<?php echo $lang; ?>/plugins/morris/morris.css">

        <link href="assets_<?php echo $lang; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets_<?php echo $lang; ?>/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets_<?php echo $lang; ?>/js/modernizr.min.js"></script>

        <link href="assets_<?php echo $lang; ?>/plugins/dropzone/dropzone.min.css" rel="stylesheet" />			
        <link href="assets_<?php echo $lang; ?>/plugins/dropzone/basic.min.css" rel="stylesheet" />	
        <link href="assets_<?php echo $lang; ?>/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />	
        <link href="assets_<?php echo $lang; ?>/fullcalender/fullcalendar.css" rel="stylesheet" />

        <?php if ($lang == 'ar') { ?>
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Changa:wght@400;700&display=swap" rel="stylesheet">
            <style>
                * {
                    font-family: 'Changa', sans-serif;
                }

                h1, h2, h3, h4, h5, h6 {
                    font-family: 'Changa', sans-serif;
                }
            </style>
        <?php } ?>
    </head>
    <body <?php if($lang == 'ar') echo "dir='rtl'"; ?>>
        <style>

            .thumb-img {
                width: 20%;
                height: 20%;
            }
        </style>
        
        <style>
        .pager  .active   a {
            background-color: #448bf4;

        }
       </style>