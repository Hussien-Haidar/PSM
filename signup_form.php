<?php include('header.php'); ?>
<?php include('header_map.php'); ?>

<style>
    #btn {
        top: 150px;
        font-family: calibri;
        width: 150px;
        padding: 10px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        border: 1px dashed #BBB;
        text-align: center;
        background-color: wheat;
        cursor: pointer;
    }
</style>

<body>
    <?php include('navbar_index.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span8" id="">
                <div class="row-fluid">
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <form onsubmit="return validateForm()" action="signup.php" class="form-signin" method="post" enctype="multipart/form-data">
                                <h3 class="form-signin-heading"><i class="icon-user"></i> Please Enter All Requirements</h3>

                                <div class="span6">
                                    <input type="text" class="input-block-level" id="full_name" name="full_name" placeholder="Full Name" required>
                                    <input type="email" class="input-block-level" id="email" name="email" placeholder="Email" required>
                                    <input type="tel" pattern="^(?:\+961|961|00961)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81|03|3|01|1)\d{6}$" class="input-block-level" id="phone_number" name="phone_number" placeholder="Whatsapp, 78123456" required>
                                    <input type="text" class="input-block-level" id="location" placeholder="Location" readonly>
                                    <input type="hidden" class="input-block-level" id="latlng" name="location" value="">
                                </div>

                                <div class="span5">
                                    <input type="text" class="input-block-level" id="pharmacy_name" name="pharmacy_name" placeholder="Pharmacy Name" required>

                                    <div style="background-color: whitesmoke;" id="btn" onclick="getFile()">Upload your certificate</div>
                                    <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" name="certificate" accept="image/*" onchange="sub(this)" required /></div>

                                    <script>
                                        function getFile() {
                                            document.getElementById("upfile").click();
                                        }

                                        function sub(obj) {
                                            var file = obj.value;
                                            var fileName = file.split("\\");
                                            if (fileName != '') {
                                                document.getElementById("btn").innerHTML = fileName[fileName.length - 1];
                                            } else {
                                                document.getElementById("btn").innerHTML = 'Upload your certificate';
                                            }
                                            event.preventDefault();
                                            document.myForm.submit();
                                        }
                                    </script>

                                    <button data-placement="top" title="Click to Sign Up" id="signup" name="signup" class="btn btn-success" type="submit"><i class="icon-check icon-large"></i> Save</button>
                                </div>

                                <div class="span11">
                                    <div class="alert alert-danger alert-triangle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 13.5">
                                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                                        </svg>
                                        <b id='note'> Please note that the request you want to send may take us up to 24 hours to response to it.</b>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#signup').tooltip('show');
                                        $('#signup').tooltip('hide');
                                    });
                                </script>
                            </form>

                            <script>
                                function validateForm() {
                                    var locationField = document.getElementById("location");
                                    if (locationField.value.trim() === "") {
                                        alert("Please embed a marker on the map on your pharmacy to get its location.");
                                        return false;
                                    }
                                    return true;
                                }
                            </script>
                        </div>
                        <?php include('script.php'); ?>
                    </div>
                </div>
            </div>

            <div class="span4" id="">
                <div class="row-fluid">
                    <div id="block_bg" class="block">
                        <div id="map"></div>

                        <script>
                            var map = L.map("map").setView([33.857899, 35.797959], 8);

                            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                            }).addTo(map);

                            var locationMarker = null;

                            function onMapClick(e) {
                                // If there's already a location marker, remove it
                                if (locationMarker) {
                                    map.removeLayer(locationMarker);
                                }

                                var latLng = e.latlng;
                                var latitude = latLng.lat;
                                var longitude = latLng.lng;

                                locationMarker = L.marker(latLng).addTo(map);

                                locationMarker.bindPopup(
                                    "Done? if you are sure from location continue filling the request, <a>note that it takes some moments to get the location</a>"
                                ).openPopup();

                                document.getElementById("latlng").value = latitude + ", " + longitude;

                                var apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;

                                fetch(apiUrl)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Extract the location name from the API response
                                        var locationName = data.display_name;

                                        // Display the location name
                                        document.getElementById("location").value = locationName;
                                    })
                                    .catch(error => console.error(error));
                            }

                            map.on("click", onMapClick);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>