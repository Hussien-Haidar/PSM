<?php include('session.php'); ?>
<?php include('header.php'); ?>

<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_fees.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-right">
										<a href="fees.php"><i class="icon-arrow-left icon-large"></i> Back</a>
								</div>
                            </div>
                            <div class="block-content collapse in">
												<?php
						$query = mysqli_query($conn,"select * from orders where order_id = '$get_id'");
						$row = mysqli_fetch_array($query);
					
						?>
						<div class="alert alert-success">ORDER DETAILS</div>
						<div class="span6">
						Item: <strong><?php echo $row['title']; ?></strong><hr>
						Description: <strong><?php echo $row['description']; ?></strong><hr>
						Fragile: <strong><?php if($row['fragile'])echo 'Yes'; else echo 'No'; ?></strong><hr>
						<?php 
						if($row["pricing_lira"] ==1){
						    echo "Price (L.L): <strong>".$row['uncharged_price']."</strong><hr>";
						    echo "Equivalent Price ($$): <strong>".$row['uncharged_price$']."</strong><hr>";
						}
						else{
						    echo "Price ($$): <strong>".$row['uncharged_price$']."</strong><hr>";
						}
						?>
						Delivery Charge: <strong><?php echo $row['delivery_charge']; ?></strong><hr>
						Status: <strong><?php echo $row['status']; ?></strong><hr>
						</div>
						<div class="span5">
						
						Sender: <strong><?php echo $row['sender_name'];  ?></strong><hr>
						Sender Phone: <strong><?php echo $row['sender_phone']; ?></strong><hr>
						Sender Email: <strong><?php echo $row['sender_email']; ?></strong><hr>
						Sender Address: <strong><?php echo $row['sender_address']; ?></strong><hr>
						
						<?php 
						$route=$row['route'];
						$q3 = mysqli_query($conn,"select * from charge where governorate_id=$route ");
		                $row3 = mysqli_fetch_array($q3);
		                $gov=$row3["governorate"];
						?>
						DESTINATION: <strong><?php echo $gov; ?></strong><hr>
					
						</div>
<div class="span12">
						<div class="alert alert-success">RECEIVER DETAILS</div>
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
		<thead>
		<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					
					<th class="empty"></th>
		</tr>
		</thead>
		<tbody>

		<tr>
		<td><?php echo $row['receiver_name']; ?></td> 
		<td><?php echo $row['receiver_email']; ?></td> 
		<td><?php echo $row['receiver_phone']; ?></td> 
		<td><?php echo $row['receiver_address']; ?></td> 
		</tr>
   
	
		</tbody>
	</table>

</div>
							

                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>	
</html>