<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'pharmacist') echo 'access denied';
else { ?>
	<?php include('header.php'); ?>
	<?php include('header_map.php'); ?>
	<?php $get_id = $_GET['id']; ?>

	<body>
		<?php include('navbar.php'); ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9" id="">
					<div class="row-fluid">
						<div id="block_bg" class="block">
							<div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Pharmacist</div>
								<div class="muted pull-right"><a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a></div>
							</div>
							<div class="block-content collapse in">
								<?php
								$query = mysqli_query($con, "select * from pharmacists where id = '$get_id'");
								$row = mysqli_fetch_array($query);
								$latLng = $row['location'];
								?>
								<form action="update_pharmacist.php" id="update_pharmacist" class="form-signin" method="post">
									<div class="span4">
										<input type="hidden" value="<?php echo $row['id']; ?>" class="input-block-level" name="id" required>

										<label>FULL NAME:</label>
										<input type="text" class="input-block-level" name="full_name" value="<?php echo $row['full_name']; ?>" required>

										<label>PHARMACY NAME:</label>
										<input type="text" class="input-block-level" name="pharmacy_name" value="<?php echo $row['pharmacy_name']; ?>" required>

										<label>PHONE NUMBER:</label>
										<input type="tel" pattern="^(?:\+961|961|0)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81)\d{6}$" class="input-block-level" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>

										<label>LOCATION</label>
										<input type="text" class="input-block-level" id="location" readonly>

										<input id="latlng" type="hidden" name="location" value="<?php echo $row['location']; ?>">

										<button type="submit" class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>
									</div>

									<div class="span8">
										<div id="map"></div>

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
													"You have changed the location</a>"
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

											map.on("click", onMapClick);
										</script>
									</div>
								</form>
								<script>
									jQuery(document).ready(function($) {
										$("#update_pharmacist").submit(function(e) {
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "update_pharmacist.php",
												data: formData,
												success: function(html) {
													$.jGrowl("Account Successfully Updated", {
														header: 'Account Updated'
													});
													var delay = 1000;
													setTimeout(function() {
														window.location = 'pharmacists.php?eraseCache=true'
													}, delay);
												}
											});
										});
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

<?php } ?>

</html>