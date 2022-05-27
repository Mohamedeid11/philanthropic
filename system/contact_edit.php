<?php
include("config.php");
if (!loggedin()) {
    header("Location: login.php");
    exit();
} if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit();
}
include 'models/Contact.php';

?>

<?php
// error_reporting(0);

$contactObj = new Contact();

if (isset($_POST['contact_update'])) {

    $id = $_POST['id_update'];
    $address_en = mysqli_real_escape_string($con, trim($_POST['address_en']));
    $address_ar = mysqli_real_escape_string($con, trim($_POST['address_ar']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
    $lat_loca = mysqli_real_escape_string($con, trim($_POST['lat_loca']));
    $long_loca = mysqli_real_escape_string($con, trim($_POST['long_loca']));

    $contact = $contactObj->getById($id);

    $errors = array();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            //echo $error, '<br />';
            echo get_error($error);
        }
    } else {

        $update = $contactObj->update([
            'id' => $id,
            'address_en' => $address_en,
            'address_ar' => $address_ar,
            'email' => $email,
            'phone' => $phone,
            'lat_loca' => $lat_loca,
            'long_loca' => $long_loca,
        ]);

        if ($update) {
            echo get_success(trans('updatedSuccessfully'));
        } else {
            echo get_error(trans('somethingWrong'));
        }
    }
}
?>
<!DOCTYPE html>
<html>
<?php include("include/heads.php"); ?>
<?php include("include/leftsidebar.php"); ?>
<div class="wrapper">
    <div class="container">    <!-- Start content -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"> <?= trans('contact'); ?> </h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><?= trans('contact'); ?>  </a>
                    </li>
                    <li class="active">
                        <?= trans('edit_contact'); ?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                    if (isset($_GET['contact_id'])) {
                        $row_select = $contactObj->getById($_GET['contact_id']);
                        $id = $row_select['id'];
                        $address_en = $row_select['address_en'];
                        $address_ar = $row_select['address_ar'];
                        $email = $row_select['email'];
                        $phone = $row_select['phone'];
                        $lat_loca = $row_select['lat_loca'];
                        $long_loca = $row_select['long_loca'];
                        if ($row_select) {
                            ?>

                            <form method="POST" enctype="multipart/form-data" data-parsley-validate novalidate>

                                <input type="hidden" name="id_update" id="id_update" parsley-trigger="change"  value="<?= $id; ?>" class="form-control">

                                <div class="form-group col-md-6">
                                    <label for="address_en"><?= trans('address_en'); ?></label>
                                    <input type="text" value="<?= $address_en; ?>" name="address_en" required class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="address_ar"><?= trans('address_ar'); ?></label>
                                    <input type="text" value="<?= $address_ar; ?>" name="address_ar" required class="form-control">
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-6">
                                    <label for="email"><?= trans('email'); ?></label>
                                    <input type="email" value="<?= $email; ?>" name="email" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-md-6">
                                    <label for="phone"><?= trans('phone'); ?></label>
                                    <input type="number" value="<?= $phone; ?>" name="phone" required class="form-control">

                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-sm-12" id="map" style="height: 300px"></div>
                                <div class="form-group col-md-3">
                                    <label><?= trans('lat'); ?></label>
                                    <input type="text" id="lat" class="form-control" name="lat_loca" value="<?= $lat_loca; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label><?= trans('long'); ?></label>
                                    <input type="text" id="lang" class="form-control" name="long_loca" value="<?= $long_loca; ?>">
                                </div>

                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center p-20">
                                            <button type="reset" class="btn w-sm btn-white waves-effect"><?= trans('cancel'); ?></button>
                                            <button type="submit" name="contact_update" class="btn w-sm btn-default waves-effect waves-light"><?= trans('update'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



</div>
</div>
<?php include("include/footer_text.php"); ?>

<?php include("include/footer.php"); ?>

<!--Start A Map -->

<script>
    var map;
    var markers = [];

    function initMap() {
        var haightAshbury = {lat: <?= $lat_loca; ?>, lng: <?= $long_loca; ?>};

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: haightAshbury,
            mapTypeId: 'terrain'
        });

        $('#lat').val('<?= $lat_loca; ?>');
        $('#lang').val('<?= $long_loca; ?>');
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
<script>
    $(document).ready(function () {


        $("#lat").on("input", function(){
            // // Print entered value in a div box
            var lat=$("#lat").val();
            var lang=$("#lang").val();

            var haightAshbury =  {lat: 25.561052, lng: 45.313753};
            haightAshbury["lat"]=Number(lat);
            haightAshbury["lng"]=Number(lang);

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);


            console.log(haightAshbury);
        });


        $("#lang").on("input", function(){
            // // Print entered value in a div box
            var lat=$("#lat").val();
            var lang=$("#lang").val();

            var haightAshbury =  {lat: 25.561052, lng: 45.313753};
            haightAshbury["lat"]=Number(lat);
            haightAshbury["lng"]=Number(lang);

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);


            console.log(haightAshbury);
        });



        $("#cssmenu ul>li").removeClass("active");
        $("#item8").addClass("active");
    });
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeuOTzbTLT2EHbvjzyHCckOiIpnTRZjSY&callback=initMap">
</script>

<!--End A Map-->
</body>
</html>