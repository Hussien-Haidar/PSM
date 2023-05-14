<?php include('dbcon.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div style="overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		<div class="pull-right">
			<a href="add_pharmacist.php" class="btn btn-inverse"><i class="icon-plus-sign icon-large"></i> Add Pharmacist</a>
		</div>

		<div>
			<a href="?status" <?php if (!isset($_GET["status"]) || $_GET["status"] == "") echo "class='btn btn-success'";
								else echo "class='btn'";  ?>> All</a>

			<a href="?status=active" <?php if (!isset($_GET["status"]) || $_GET["status"] != "active") echo "class='btn'";
										else if (isset($_GET["status"]) && $_GET["status"] == "active") echo "class='btn btn-success'"; ?>> Active</a>

			<a href="?status=disabled" <?php if (!isset($_GET["status"]) || $_GET["status"] != "disabled") echo "class='btn'";
										else if (isset($_GET["status"]) && $_GET["status"] == "disabled") echo "class='btn btn-success'"; ?>> Disabled</a>

		</div>

		<br>

		<thead>
			<tr>
				<th></th>
				<th>Username</th>
				<th>Full Name</th>
				<th>Pharmacy</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Location</th>
				<th>Date Created</th>
				<th class="empty">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if (isset($_GET["status"]) && $_GET["status"] == "active") {
				$query = mysqli_query($con, "select * from pharmacists where status='verified'") or die('Error, insert query failed');
				$count = mysqli_num_rows($query);
			} else if (isset($_GET["status"]) && $_GET["status"] == "disabled") {
				$query = mysqli_query($con, "select * from pharmacists where status='disabled'") or die('Error, insert query failed');
				$count = mysqli_num_rows($query);
			} else {
				$query = mysqli_query($con, "select * from pharmacists") or die('Error, insert query failed');
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
			$index = -1;
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$status[] = $row['status'];
				$index += 1;
			?>
				<tr>
					<?php if ($status[$index] == 'verified') { ?>
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
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['full_name']; ?></td>
					<td><?php echo $row['pharmacy_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['phone_number']; ?></td>
					<td>
						<a href="view_location.php?id=<?php echo $id; ?>&role=pharmacist" id="location_<?php echo $row['id']; ?>"></a>
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
					<td><?php echo $row['created_at']; ?></td>

					<td class="empty" width="160">
						<div class="dropdown">
							<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action
								<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li>
									<a data-placement="left" title="Click to View Certificate" id="view<?php echo $id; ?>" href="view_certificate.php<?php echo '?id=' . $row['id']; ?>" class="btn"><i class="icon-search icon-large"></i> Certificate</a>
									<script type="text/javascript">
										$(document).ready(function() {
											$('#view<?php echo $id; ?>').tooltip('show');
											$('#view<?php echo $id; ?>').tooltip('hide');
										});
									</script>
								</li>

								<li>
									<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="edit_pharmacist.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-pencil icon-large"></i> Edit</a>
									<script type="text/javascript">
										$(document).ready(function() {
											$('#edit<?php echo $id; ?>').tooltip('show');
											$('#edit<?php echo $id; ?>').tooltip('hide');
										});
									</script>
								</li>

								<li>
									<?php
									if (isset($_GET['status']) && $_GET['status'] == "active") { ?>
										<a data-toggle="modal" title="Click to disable account" href="#pharmacist_disable_<?php echo $id; ?>" id="disable<?php echo $id; ?>" class="btn"><i class="icon-lock icon-large"></i> Disable</a>
									<?php
									} else if (isset($_GET['status']) && $_GET['status'] == "disabled") { ?>
										<a data-toggle="modal" title="Click to enable account" href="#pharmacist_enable_<?php echo $id; ?>" id="enable<?php echo $id; ?>" class="btn"><i class="icon-unlock icon-large"></i> Enable</a>
										<?php
									} else {
										if ($row['status'] == 'disabled') { ?>
											<a data-toggle="modal" title="Click to enable account" href="#pharmacist_enable_<?php echo $id; ?>" id="enable<?php echo $id; ?>" class="btn"><i class="icon-unlock icon-large"></i> Enable</a>
										<?php
										} else if ($row['status'] == 'verified') { ?>
											<a data-toggle="modal" title="Click to disable account" href="#pharmacist_disable_<?php echo $id; ?>" id="disable<?php echo $id; ?>" class="btn"><i class="icon-lock icon-large"></i> Disable</a>
									<?php
										}
									}
									?>

									<script type="text/javascript">
										$(document).ready(function() {
											$('#disable<?php echo $id; ?>').tooltip('show');
											$('#disable<?php echo $id; ?>').tooltip('hide');
										});
										$(document).ready(function() {
											$('#enable<?php echo $id; ?>').tooltip('show');
											$('#enable<?php echo $id; ?>').tooltip('hide');
										});
									</script>
								</li>

								<li>
									<a data-toggle="modal" title="Delete account" href="#pharmacist_delete_<?php echo $id; ?>" id="delete<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i> Delete</a>
									<script type="text/javascript">
										$(document).ready(function() {
											$('#delete<?php echo $id; ?>').tooltip('show');
											$('#delete<?php echo $id; ?>').tooltip('hide');
										});
									</script>
								</li>
							</ul>
						</div>
					</td>
				</tr>

				<?php include('modal_delete_pharmacist.php'); ?>
				<?php include('modal_enable_pharmacist.php'); ?>
				<?php include('modal_disable_pharmacist.php'); ?>
			<?php } ?>

		</tbody>
	</table>
</div>