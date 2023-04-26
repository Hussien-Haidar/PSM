	<?php include('dbcon.php'); ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<form action="pay_fees.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
	
		
		<div class="pull-right">
			<a href="?status=unexempted" <?php if($_GET["status"]!="exempted") echo "class='btn btn-success'"; else echo "class='btn'"; ?>>Not Exempted</a> 
			<a href="?status=exempted" <?php if($_GET["status"]=="exempted") echo "class='btn btn-success'"; else echo "class='btn'"; ?>> Exempted</a> 
			
		</div>
	<!--	<div class="pull-right">
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 
	</div>-->
<br><br>
		<thead>
		<?php	if($_GET["status"]!="exempted"){?>
		<tr>
					<th>Select</th>
					<th>Order ID</th>
					<th>Seller</th>
					<th>Date</th>
					<th>Total L.L</th>	
					
					<th>Fee to Pay</th>
				
		</tr>
		<?php } 
		else {?>
<tr>
					<th>Statement ID</th>
					<th> Seller</th>
					<th>Statement Date</th>
					<th>Total L.L</th>	
					<th>Issued By</th>
					<th>Payed Orders</th>
					<th>Comments</th>
					<th>Print Invoice</th>
				
		</tr>
<?php		}
		?>
		</thead>
		<tbody>
		<?php
		if($_GET["status"]!="exempted"){
		    $query = mysqli_query($conn,"select * from orders where status='delivered' AND isExempted=0 AND sender_id='$user_id'")or die('Nothing to Display');
		

		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query)){

		$order_id =$row2['order_id'];
		$sender_name =$row2['sender_name'];
		$order_date=$row2["createdAt"];
		$total_L=$row2["uncharged_price"];
		$status =$row2['status']; 	
		?>
		<tr>
		<td class="empty" width="30"><input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $order_id; ?>"></td>
		
		<td><?php echo $order_id; ?></td> 
		<td><input type="hidden" name="sender_name" value="<?php echo $sender_name; ?>" /><?php echo $sender_name; ?></td>
		<td><input type="hidden" name="order_date" value="<?php echo $order_date; ?>" /><?php echo $order_date; ?></td> 
		<td><input type="hidden" name="total_L" value="<?php echo $total_L; ?>" /><?php echo $total_L; ?></td> 
		
		<td class="empty" width="150">
		
		<a data-placement="top" title="Click to View all Details" id="view<?php echo $order_id; ?>" style="color:black"  href="view_pay.php<?php echo '?id='.$order_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-search icon-large"></i> View Payment</a>
			
		</td>
		</tr>
	  <?php }
	 }
		else{
		$query = mysqli_query($conn,"select * from statements where seller_id='$user_id' order by stmt_date DESC")or die('Error, insert query failed');
	//Table of all Statements:
		while($row2= mysqli_fetch_array($query)){

		$stmt_id =$row2['stmt_id'];
		$seller_name =$row2['seller_name'];
		$stmt_date=$row2["stmt_date"];
		$total_L=$row2["total_L"];
		$issuer =$row2['issued_by'];
		$comments =$row2['comments'];
		$orders_id=$row2["orders_id"];	
		?>
		<tr>
		
		<td><?php echo $stmt_id; ?></td> 
		<td><?php echo $seller_name; ?></td>
		<td><?php echo $stmt_date; ?></td> 
		<td><?php echo $total_L; ?></td> 
		<td><?php echo $issuer; ?></td>
		<td><?php echo $orders_id; ?></td>
		<td><?php echo $comments; ?></td>
		<td class="empty" width="150">
		
		<a data-placement="top" title="Click to Print Invoice" id="print<?php echo $stmt_id; ?>" style="color:black" target="_blank" href="print_statement.php<?php echo '?id='.$stmt_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-print icon-large"></i>Print Statement</a>
			
		</td>
		</tr>
	  <?php }
	} 
	  ?>  
	
		</tbody>
	</table>
	</form>