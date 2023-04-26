<?php include('dbcon.php'); ?>

<div style="overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" borders="0" class="table" id="example">
		<div>
			<a href="?status" <?php if (!isset($_GET["status"]) || $_GET["status"] == "") echo "class='btn btn-success'";
								else echo "class='btn'";  ?>> Active</a>

			<a href="?status=rejected" <?php if (!isset($_GET["status"]) || $_GET["status"] != "rejected") echo "class='btn'";
										else if (isset($_GET["status"]) && $_GET["status"] == "rejected") echo "class='btn btn-success'"; ?>> Rejected</a>
		</div>

		<br>

		<thead>
			<tr>
				<th>Full Name</th>
				<th>Pharmacy Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Location</th>
				<th class="empty">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if (isset($_GET["status"]) && $_GET["status"] == "rejected") {
				$query = mysqli_query($con, "select * from requests where status='rejected'");
				$count = mysqli_num_rows($query);

				while ($row = mysqli_fetch_array($query)) {
					$id = $row['id']; ?>
					<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['pharmacy_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone_number']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td class="empty" width="160">
							<div class="dropdown">
								<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action
									<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li>
										<a data-placement="left" title="Click to View Certificate" id="view<?php echo $id; ?>" href="view_certificate.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-search icon-large"></i> Certificate</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#view<?php echo $id; ?>').tooltip('show');
												$('#view<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>

									<li>
										<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="edit_request.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-pencil icon-large"></i> Edit</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#edit<?php echo $id; ?>').tooltip('show');
												$('#edit<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>

									<li>
										<a data-toggle="modal" title="Click to Delete account" href="#request_delete_<?php echo $id; ?>" id="delete<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i> Delete</a>
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
				<?php include('modal_delete_request.php');
				}
			} else {
				$query = mysqli_query($con, "select * from requests where status='active'");
				$count = mysqli_num_rows($query);

				while ($row = mysqli_fetch_array($query)) {
					$id = $row['id'];
					$full_name = $row['full_name'];
					$pharmacy_name = $row['pharmacy_name'];
					$email = $row['email'];
					$phone_number = $row['phone_number'];
					$certificate = $row['certificate'];
					$location = $row['location']; ?>

					<tr>
						<td><?php echo $row['full_name']; ?></td>
						<td><?php echo $row['pharmacy_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone_number']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td class="empty" width="160">
							<div class="dropdown">
								<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action
									<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li>
										<a data-placement="left" title="Click to View Certificate" id="view<?php echo $id; ?>" href="view_certificate.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-search icon-large"></i> Certificate</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#view<?php echo $id; ?>').tooltip('show');
												$('#view<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>

									<li>
										<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="edit_request.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-pencil icon-large"></i> Edit</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#edit<?php echo $id; ?>').tooltip('show');
												$('#edit<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>

									<li>
										<a data-toggle="modal" title="Click to Accept account" href="#request_accept_<?php echo $id; ?>" id="accept<?php echo $id; ?>" class="btn btn-success"><i class="icon-ok-sign icon-large"></i> Accept</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#accept<?php echo $id; ?>').tooltip('show');
												$('#accept<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>

									<li>
										<a data-toggle="modal" title="Click to Reject account" href="#request_reject_<?php echo $id; ?>" id="reject<?php echo $id; ?>" class="btn btn-danger"><i class="icon-remove icon-large"></i> Reject</a>
										<script type="text/javascript">
											$(document).ready(function() {
												$('#reject<?php echo $id; ?>').tooltip('show');
												$('#reject<?php echo $id; ?>').tooltip('hide');
											});
										</script>
									</li>
								</ul>
							</div>
						</td>
					</tr>
			<?php include('modal_reject_request.php');
					include('modal_accept_request.php');
				}
			}
			?>

			<script>
				var count = <?php echo $count; ?>;
				document.getElementById("count").innerHTML = count;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "updateVariable.php?value=" + count, true);
				xmlhttp.send();
			</script>

		</tbody>

	</table>
</div>