<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'pharmacist') echo 'access denied';
else { ?>
	<?php include('header.php'); ?>

	<body>
		<?php include('navbar.php'); ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<?php include('sidebar_users.php'); ?>
				<div class="span3" id="">
					<?php include('add_admin.php');  ?>
				</div>
				<div class="span6" id="">
					<div class="row-fluid">
						<!-- block -->
						<div id="block_bg" class="block">
							<div class="navbar navbar-inner block-header">
								<?php
								$query = mysqli_query($con, "select * from users");
								$count = mysqli_num_rows($query);
								?>
								<div class="muted pull-left"><i class="icon-reorder icon-large"></i> List</div>
								<div class="muted pull-right">
									Number of Accounts: <span id="count" class="badge badge-info"><?php echo $count; ?></span>
								</div>
							</div>

							<div class="block-content collapse in">
								<div class="span12">
									<div style="overflow-x:auto;">

										<div>
											<a href="?status" <?php if (!isset($_GET["status"]) || $_GET["status"] == "") echo "class='btn btn-success'";
																else echo "class='btn'";  ?>> Administrators</a>

											<a href="?status=users" <?php if (!isset($_GET["status"]) || $_GET["status"] != "users") echo "class='btn'";
																	else if (isset($_GET["status"]) && $_GET["status"] == "users") echo "class='btn btn-success'"; ?>> Users</a>
										</div>

										<br>

										<table cellpadding="0" cellspacing="0" borders="0" class="table" id="example">
											<?php
											if (isset($_GET["status"]) && $_GET["status"] == "users") {
												$query = mysqli_query($con, "select * from users");
												$count = mysqli_num_rows($query);
											?>
												<thead>
													<tr>
														<th>Full name</th>
														<th>Email</th>
														<th>Date Created</th>
													</tr>
												</thead>

												<tbody>
													<?php
													while ($row = mysqli_fetch_array($query)) {
														$id = $row['id'];
													?>
														<tr>
															<td><?php echo $row['full_name']; ?></td>
															<td><?php echo $row['email']; ?> </td>
															<td><?php echo $row['created_at']; ?></td>
														</tr>
													<?php } ?>
												</tbody>
											<?php
											} else {
												$query = mysqli_query($con, "select * from admins");
												$count = mysqli_num_rows($query);
											?>
												<thead>
													<tr>
														<th></th>
														<th>Username</th>
														<th>Full Name</th>
														<th>Email</th>
														<th>Date Created</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php
													while ($row = mysqli_fetch_array($query)) {
														$id = $row['id'];
													?>
														<tr>
															<?php if ($row['username'] == $_SESSION['username']) { ?>
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
															<td><?php echo $row['username']; ?> </td>
															<td><?php echo $row['full_name']; ?> </td>
															<td><?php echo $row['email']; ?> </td>
															<td><?php echo $row['created_at']; ?></td>
															<td class="empty" width="160">

																<div class="dropdown">
																	<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action
																		<span class="caret"></span></button>
																	<ul class="dropdown-menu">
																		<li>
																			<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="edit_admin.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-pencil icon-large"></i> Edit</a>
																			<script type="text/javascript">
																				$(document).ready(function() {
																					$('#edit<?php echo $id; ?>').tooltip('show');
																					$('#edit<?php echo $id; ?>').tooltip('hide');
																				});
																			</script>
																		</li>

																		<li>
																			<a data-toggle="modal" title="Delete admin" href="#admin_delete_<?php echo $id; ?>" id="delete<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i> Delete</a>
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

															<script type="text/javascript">
																$(document).ready(function() {
																	$('#view<?php echo $id; ?>').tooltip('show');
																	$('#view<?php echo $id; ?>').tooltip('hide');
																});
															</script>
														</tr>
													<?php
														include('modal_delete_admin.php');
													} ?>
												</tbody>
											<?php
											}
											?>

											<script>
												var count = <?php echo $count; ?>;
												document.getElementById("count").innerHTML = count;
												var xmlhttp = new XMLHttpRequest();
												xmlhttp.open("GET", "updateVariable.php?value=" + count, true);
												xmlhttp.send();
											</script>

										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('script.php'); ?>
	</body>

<?php } ?>

</html>