	<?php include('dbcon.php'); ?>
	<?php include('session.php'); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<form action="delete_order.php" method="post">
		<div style="overflow-x:auto;">
			<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
				<div class="pull-right">
					<a href="excel_orders.php" class="btn btn-success"><i class="icon-print icon-large"></i> Export Excel</a>
					<a href="add_order.php" class="btn btn-inverse"><i class="icon-plus-sign icon-large"></i> Add Order</a>
				</div>
				<div>
					<a href="?" <?php if ($_GET["status"] == null || $_GET["status"] == "") echo "class='btn btn-success'";
								else echo "class='btn'";  ?>> All</a>
					<a href="?status=pending" <?php if ($_GET["status"] == "pending") echo "class='btn btn-success'";
												else echo "class='btn'"; ?>> Pending</a>
					<a href="?status=ready to assign" <?php if ($_GET["status"] == "ready to assign") echo "class='btn btn-success'";
														else echo "class='btn'"; ?>>Ready to Assign</a>
					<a href="?status=active" <?php if ($_GET["status"] == "active") echo "class='btn btn-success'";
												else echo "class='btn'"; ?>>Active</a>
				    <a href="?status=delivered" <?php if ($_GET["status"] == "delivered") echo "class='btn btn-success'";
												else echo "class='btn'"; ?>> Delivered</a>								
					<a href="?status=returned" <?php if ($_GET["status"] == "returned") echo "class='btn btn-success'";
												else echo "class='btn'"; ?>> Returned</a>
					<a href="?status=canceled" <?php if ($_GET["status"] == "canceled") echo "class='btn btn-success'";
												else echo "class='btn'"; ?>>Canceled</a>
				</div>
				<br>
				<!--	<a data-toggle="modal" href="#order_delete" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"></i> Delete</a>-->

				<thead>
					<tr>
						<th>Order ID</th>
						<th>Sender</th>
						<th>Date</th>
						<th>Receiver</th>
						<th>Status</th>
						<th>Route Destination</th>

						<th class="empty">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					if ($_GET["status"] != null && $_GET["status"] != "") {
						$status = $_GET["status"];
						$query = mysqli_query($conn, "select * from orders where status='$status' AND sender_id= $user_id") or die('Error, query failed');
					} else {
						$query = mysqli_query($conn, "select * from orders where sender_id= $user_id") or die('Error, insert query failed');
					}
					while ($row = mysqli_fetch_array($query)) {

					$sen_id=$row["sender_id"];
					if($sen_id!=0 && $sen_id!="0"){
		$q1 = mysqli_query($conn,"select * from users where user_id=$sen_id ")or die('Error, insert query failed');
		$row1 = mysqli_fetch_array($q1);
		if($row1["sender_name"]!=null){
		    $sender_name=$row1["sender_name"];
		    $sender_phone=$row1["sender_phone"];
		}	else{
		    $sender_name=$row["sender_name"];
		    $sender_phone=$row["sender_phone"];
		}
					}
		else{
		    $sender_name=$row["sender_name"];
		    $sender_phone=$row["sender_phone"];
		}
		$id = $row['order_id'];
	
						
					?>
						<tr>
							<td><?php echo $row['order_id']; ?></td>
							<td><?php echo $sender_name;?><br><?php echo $sender_phone;?></td>
							<td><?php echo substr($row['createdAt'], 0, 10); ?></td>
							<td><?php echo $row['receiver_name']; ?><br><?php echo $row['receiver_phone']; ?></td>
							<td><?php echo $row['status']; ?></td>

							<td>
								<?php
								$route = $row['route'];
								$q2 = mysqli_query($conn, "select * from charge where governorate_id=$route ") or die('Error, insert query failed');
								$row2 = mysqli_fetch_array($q2);
								$gov = $row2["governorate"];
								echo $gov; ?></td>
							<!--	<td class="empty" width="20"><input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php //echo $id; 
																																							?>"></td>-->
							<td class="empty" width="160">

								<div class="dropdown">
									<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action
										<span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li> <a data-placement="top" title="Click to View all Details" id="view<?php echo $id; ?>" href="view_order.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-search icon-large"></i> View</a>
											<script type="text/javascript">
												$(document).ready(function() {
													$('#view<?php echo $id; ?>').tooltip('show');
													$('#view<?php echo $id; ?>').tooltip('hide');
												});
											</script>
										</li>
										<li><?php if($row['status']=="pending") { ?>
											<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="edit_order.php<?php echo '?id=' . $id; ?>" class="btn"><i class="icon-pencil icon-large"></i> Edit</a>
										<?php } ?>
											<script type="text/javascript">
												$(document).ready(function() {
													$('#edit<?php echo $id; ?>').tooltip('show');
													$('#edit<?php echo $id; ?>').tooltip('hide');
												});
											</script>
										</li>
										<li> 
										<?php if($row['status']=="pending" || $row['status']=="ready to assign") { ?>
										<a data-toggle="modal" href="#order_delete" id="delete" class="btn btn-danger" name=""><i class="icon-trash icon-large"></i> Delete</a>
										<?php } ?>
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
							</td>
						</tr>
						<?php include('modal_delete.php'); ?>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</form>