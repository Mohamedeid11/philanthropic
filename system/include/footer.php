



<!-- jQuery  -->
<script src="assets_<?php echo $lang; ?>/js/jquery.min.js"></script>
<script src="assets_<?php echo $lang; ?>/js/bootstrap.min.js"></script>
<script src="assets_<?php echo $lang; ?>/js/detect.js"></script>
<script src="assets_<?php echo $lang; ?>/js/fastclick.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jquery.slimscroll.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jquery.blockUI.js"></script>
<script src="assets_<?php echo $lang; ?>/js/waves.js"></script>
<script src="assets_<?php echo $lang; ?>/js/wow.min.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jquery.nicescroll.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jquery.scrollTo.min.js"></script>


<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/switchery/js/switchery.min.js"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


<script src="assets_<?php echo $lang; ?>/plugins/notifyjs/dist/notify.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/notifications/notify-metro.js"></script>		

<!-- plugins js -->
<script src="assets_<?php echo $lang; ?>/plugins/moment/moment.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- App core js -->
<script src="assets_<?php echo $lang; ?>/js/jquery.core.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jquery.app.js"></script>

<!-- page js -->
<script src="assets_<?php echo $lang; ?>/pages/jquery.form-pickers.init.js"></script>

<script src="assets_<?php echo $lang; ?>/plugins/bootbox/bootbox.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/bootbox/ui-alert-dialog-api.js"></script>


<script src="assets_<?php echo $lang; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/datatables/dataTables.bootstrap.js"></script>


<script src="assets_<?php echo $lang; ?>/pages/datatables.init.js"></script>

<script src="assets_<?php echo $lang; ?>/plugins/counterup/jquery.counterup.min.js"></script>


<script src="assets_<?php echo $lang; ?>/plugins/jquery-knob/jquery.knob.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/dropzone/dropzone.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/dropzone/dropzone.min.js"></script>
<script src="assets_<?php echo $lang; ?>/plugins/fullcalendar/js/fullcalendar.min.js"></script>
<script src="assets_<?php echo $lang; ?>/fullcalender/moment.min.js" type="text/javascript"></script>
<script src="assets_<?php echo $lang; ?>/fullcalender/fullcalendar.min.js" type="text/javascript"></script>


<script type="text/javascript" src="assets_<?php echo $lang; ?>/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('body').on('click', '#changeLang', function(e){
               
            let text = $(this).find('span').html();
            
            let lang = 'en';
            if(text.includes('AR')){
                lang = 'ar';
            }
            
            let url = location.href;
            url = new URL(url);
            url.searchParams.set('lang', lang);
            
            location.href = url; 
            
            e.preventDefault();
        })
        
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "assets_<?php echo $lang; ?>/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $(".knob").knob();

    });


    $(document).ready(function () {
        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            }
        });
    });
</script>

<!-- Sweet-Alert  -->
<script src="assets_<?php echo $lang; ?>/plugins/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets_<?php echo $lang; ?>/pages/jquery.sweet-alert.init.js"></script>
