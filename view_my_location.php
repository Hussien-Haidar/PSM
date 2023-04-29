<?php include('session.php'); ?>
<?php if ($_SESSION['role'] != 'pharmacist') echo 'access denied';
else {
    include('header.php');
    include('header_map.php');
    $get_id = $_GET['id']; ?>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span9" id="">
                    <div class="row-fluid">
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <?php
                                $result = mysqli_query($con, "Select * from pharmacists where id = '$get_id'");
                                $row = mysqli_fetch_array($result);
                                $full_name = $row['full_name'];
                                $latLng = $row['location'];
                                ?>

                                <div class="muted pull-left"><i style="color: lightseagreen;" class="icon-map-marker icon-large"></i> My Loction</div>

                                <div class="muted pull-right">
                                    <a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a>
                                </div>
                            </div>

                            <div id="map"></div>

                            <?php $result ?>

                            <script>
                                var latlang = '<?php echo $latLng; ?>';
                                var [latitude, longitude] = latlang.split(", ");
                                var map = L.map("map").setView([latitude, longitude], 16);

                                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                    maxZoom: 19,
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                }).addTo(map);

                                locationMarker = L.marker([latitude, longitude]).addTo(map);

                                var apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;

                                fetch(apiUrl)
                                    .then(response => response.json())
                                    .then(data => {
                                        var locationName = data.display_name;

                                        locationMarker.bindPopup(
                                            "your location is in " + locationName
                                        ).openPopup();
                                    })
                                    .catch(error => console.error(error));
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include('script.php'); ?>
    </body>

<?php } ?>