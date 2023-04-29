<?php include('dbcon.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
	a:empty:before {
		content: "Please wait...";
		color: grey;
		text-decoration: none;
	}
</style>

<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
	<div>
		<a href="?status" <?php if (!isset($_GET["status"]) || $_GET["status"] == "") echo "class='btn btn-success'";
							else echo "class='btn'";  ?>> Active</a>

		<a href="?status=disabled" <?php if (!isset($_GET["status"]) || $_GET["status"] != "disabled") echo "class='btn'";
									else if (isset($_GET["status"]) && $_GET["status"] == "disabled") echo "class='btn btn-success'"; ?>> Disabled</a>
	</div>

	<br>

	<thead>
		<tr>
			<th class="empty"></th>
			<th>Name</th>
			<th>Pharmacist</th>
			<th>Pharmacy</th>
			<th>Location</th>
			<th class="empty">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php
		if (isset($_GET["status"]) && $_GET["status"] == "disabled") {
			$query = mysqli_query($con, "SELECT medicines.*, pharmacists.id AS phar_id, pharmacists.full_name, pharmacists.pharmacy_name, pharmacists.status, pharmacists.location
			FROM medicines
			JOIN pharmacists ON medicines.id_pharmacist = pharmacists.id 
			WHERE pharmacists.status = 'disabled'");
			$count = mysqli_num_rows($query);
		} else {
			$query = mysqli_query($con, "SELECT medicines.*,pharmacists.id AS phar_id, pharmacists.full_name, pharmacists.pharmacy_name, pharmacists.status, pharmacists.location
			FROM medicines
			JOIN pharmacists ON medicines.id_pharmacist = pharmacists.id 
			WHERE pharmacists.status='verified'");
			$count = mysqli_num_rows($query);
		}
		?>

		<script>
			var count = <?php echo $count; ?>;
			document.getElementById("count").innerHTML = count;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "updateVariable.php?value=" + count, true);
			xmlhttp.send();
		</script>

		<?php
		while ($row = mysqli_fetch_array($query)) {
			$id = $row['id'];
		?>
			<tr>
				<?php if ($row['status'] == 'verified') { ?>
					<td>
						<span class="d-inline-block align-middle me-2">
							<svg class="bi" width="10" height="10" fill="green">
								<circle class="text-danger" cx="5" cy="5" r="5" />
							</svg>
						</span>
					</td>
				<?php } else { ?>
					<td>
						<span class="d-inline-block align-middle me-2">
							<svg class="bi" width="10" height="10" fill="red">
								<circle class="text-danger" cx="5" cy="5" r="5" />
							</svg>
						</span>
					</td>
				<?php } ?>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['full_name']; ?></td>
				<td><?php echo $row['pharmacy_name']; ?></td>
				<td>
					<a href="view_location.php?id=<?php echo $row['phar_id']; ?>&role=pharmacist" id="location_<?php echo $row['id']; ?>"></a>

					<script>
						var latLng = '<?php echo $row['location']; ?>';
						var [latitude, longitude] = latLng.split(", ");

						var apiUrl = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`;

						fetch(apiUrl)
							.then(response => response.json())
							.then(data => {
								// Extract the name of the place from the API response
								var placeName = data.address.village || data.address.town || data.address.city || data.address.hamlet;
								var country = data.address.country;
								document.getElementById("location_<?php echo $row['id']; ?>").textContent = placeName + ", " + country;
							})
							.catch(error => {
								console.error(error);
							});
					</script>
				</td>
				<td class="empty" width="150">
					<a data-placement="top" title="Click to View all Details" id="view<?php echo $id; ?>" style="color:black" href="view_medicine.php<?php echo '?id=' . $id; ?>" class="btn btn-warning"><i style="color:white" class="icon-search icon-large"></i> View Details</a>
				</td>

				<script type="text/javascript">
					$(document).ready(function() {
						$('#view<?php echo $id; ?>').tooltip('show');
						$('#view<?php echo $id; ?>').tooltip('hide');
					});
				</script>
				</td>
			</tr>
		<?php } ?>

	</tbody>
</table>