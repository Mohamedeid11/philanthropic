

<script src="assets_<?php echo $lang; ?>/js/jquery-3.5.1.min.js"></script>
<script src="assets_<?php echo $lang; ?>/js/jqueryui/jquery-ui.min.js"></script>
<script src="assets_<?php echo $lang; ?>/bootstrap/js/popper.js"></script>
<script src="assets_<?php echo $lang; ?>/bootstrap/js/bootstrap.js"></script>
<script src="assets_<?php echo $lang; ?>/js/website.js"></script>
<script src="assets_<?php echo $lang; ?>/js/wow.min.js"></script>
<script>new WOW().init();</script>
<!-- If It IE 9 -->
<script src="assets_<?php echo $lang; ?>/js/html5shiv.min.js"></script>
<script src="assets_<?php echo $lang; ?>/js/respond.min.js"></script>


<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//code.jquery.com/jquery-2.1.1.js"></script>

<script src="dist/sweetalert.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-42119746-3', 'auto');
    ga('send', 'pageview');
</script>
<script type="text/javascript">
// sweet alert For Cart
    $(document).ready(function(){
        $('#cart-form').on('submit',function(e) {  //Don't foget to change the id form
            $.ajax({
                url:'Donation.php', //===PHP file name====
                data:$(this).serialize(),
                type:'POST',
                success:function(data){
                    console.log(data);
                    //Success Message == 'Title', 'Message body', Last one leave as it is
                    swal("¡Success!", "<?php echo trans('addedSuccessfully'); ?>!", "success");
                    setTimeout(function(){ location.reload(); }, 2000);
                },
                error:function(data){
                    //Error Message == 'Title', 'Message body', Last one leave as it is
                    swal("Oops...", "Something went wrong :(", "error");
                }
            });
            e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
        });
    });
    //sweet alert
</script>
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
            ajax: "../system/assets_<?php echo $lang; ?>/plugins/datatables/json/scroller-demo.json",
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

<!--Start A Map -->

<script>
    var map;
    var markers = [];

    function initMap() {
        var haightAshbury = {lat: <?= $contact_lat_loca; ?>, lng: <?= $contact_long_loca; ?>};

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: haightAshbury,
            mapTypeId: 'terrain'
        });

        $('#lat').val('<?= $contact_lat_loca; ?>');
        $('#lang').val('<?= $contact_long_loca; ?>');
        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
            addMarker(event.latLng);
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            $('#lat').val(latitude);
            $('#lang').val(longitude);

        });

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        clearMarkers();
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeuOTzbTLT2EHbvjzyHCckOiIpnTRZjSY&callback=initMap">
</script>

<!--End A Map-->