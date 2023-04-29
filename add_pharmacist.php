<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'pharmacist') echo 'access denied';
else { ?>
	<?php include('header.php'); ?>
	<?php include('header_map.php'); ?>

	<body>
		<?php include('navbar.php'); ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9" id="">
					<div class="row-fluid">
						<!-- block -->
						<div id="block_bg" class="block">
							<div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Account</div>
								<div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a></div>
								<script type="text/javascript">
									$(document).ready(function() {
										$('#return').tooltip('show');
										$('#return').tooltip('hide');
									});
								</script>
							</div>
							<div class="block-content collapse in">
								<form id="add_pharmacist" class="form-signin" method="post">

									<div class="span4">
										<label>FULL NAME</label>
										<input type="text" class="input-block-level" name="full_name" required>

										<label>PHARMACY NAME</label>
										<input type="text" class="input-block-level" name="pharmacy_name" required>

										<label>EMAIL</label>
										<input type="text" class="input-block-level" name="email" required>

										<label>PHONE NUMBER</label>
										<input type="tel" pattern="^(?:\+961|961|0)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81)\d{6}$" class="input-block-level" name="phone_number" required>

										<label>LOCATION</label>
										<input type="text" class="input-block-level" id="location" placeholder="Location" readonly>

										<input type="hidden" class="input-block-level" id="latlng" name="location" value="">

										<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>
									</div>

									<div class="span8">
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
													"Done? if you are sure from location continue filling the response."
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
								</form>

								<script>
									jQuery(document).ready(function($) {
										$("#add_pharmacist").submit(function(e) {
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "save_pharmacist.php",
												data: formData,
												success: function(html) {
													if (html == 'pharmacist_added') {
														$.jGrowl("Accout Successfully Added", {
															header: 'Account Added'
														});
														var delay = 2000;
														setTimeout(function() {
															window.location = 'pharmacists.php'
														}, delay);
													} else if (html == 'empty_location') {
														$.jGrowl("Please embed a marker on the pharmacy", {
															header: 'Location is Empty'
														});

													} else {
														$.jGrowl("Email is already used", {
															header: 'Account Adding Failed'
														});
													}
												},

											});
										});
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			?>
		</div>
		<?php include('script.php'); ?>
	</body>

<?php } ?>

</html>