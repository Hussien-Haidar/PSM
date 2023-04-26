<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_incomes.php'); ?>
				<!-- Order Incomes -->
				 <div class="span9" id="1">
                     <div class="row-fluid">
                         		<form method="POST" action="">
				<div class="form-inline">
					<label>Choose Month:</label>
					<select class="form-control" name="month">
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
					<button class="btn btn-info" name="filter">Filter</button>
					
				</div>
			</form>
			<?php
				if(ISSET($_POST['filter'])){
		$category=$_POST['category'];
 /*
		$query=mysqli_query($conn, "SELECT * FROM `expenses` WHERE `category`='$category'") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
		}
	}else if(ISSET($_POST['reset'])){
		$query=mysqli_query($conn, "SELECT * FROM `motors`") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
		}
	}else{
		$query=mysqli_query($conn, "SELECT * FROM `motors`") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
			echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
		}*/
	}
			
			?>
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
						$month=date("m");
							$queryL= mysqli_query($conn,"select Sum(tL),Count(*) from orders where month='$month' ");
							if($queryL){
							$resultL = mysqli_fetch_array($queryL);
							$amountL=$resultL[0];
							$count = $resultL[1];
							}
							else {
							    $amountL=0;
							    $count=0;
							}
							$queryD= mysqli_query($conn,"select Sum(total_D) from incomes where month='$month' ");
							if($queryD){
						$res = mysqli_fetch_row($queryD);
						$amountD=$res[0];
							}
							else {
							   $amountD = 0;
							}
							
						 	
						?>
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Order Profits</div>
                                <div class="muted pull-right">
								Delivered Orders This Month: <span class="badge badge-info"><?php  echo $count;  ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
								<div class="span12" id="profitTableDiv">
								<h2 id="noch">Month Profits</h2>
									<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<form action="delete_income.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		
	<!--	<div class="pull-left">
			<span class='btn btn-info' >Month Profits L.L :</span> 
			
		
		</div>-->

	<!--	<div class="pull-right">
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 
	</div>-->

		<thead>
	
		<tr>
					
					<th>Order ID</th>
					<th>Destination</th>
					<th>Date</th>
					<th>Delivery Charge</th>	
					<th  style="color:green;font-weight:bold">Net Profit</th>
					<th>View</th>
				
				
		</tr>
	
		</thead>
		<tbody>
		<?php

$dateBegin = strtotime("first day of this month");  
$dateEnd = strtotime("last day of this month");

$firstdate=date("Y-m-d", $dateBegin);  
$lastdate=date("Y-m-d", $dateEnd);

$query2 = mysqli_query($conn,"select * from orders where (status='delivered' or status='returned') AND  (deliveredAt < '$lastdate' AND deliveredAt > '$firstdate' ) ");

        if($query2){
		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query2)){
        
		$order_id =$row2['order_id'];
		$rider=$row2["assigned_rider"];
		$q3=mysqli_query($conn,"select * from riders where rider_id=$rider Limit 1");
		$commission=0;
		if($q3){
		    $row3=mysqli_fetch_array($q3);
		    $commission=$row3["commission"];
		}
		$destination =$row2['receiver_address'];
		$dateAt=$row2["deliveredAt"];
	
		$charge=$row2["delivery_charge"];
		$total_L=$row2['delivery_charge']-$commission; 
		?>
		<tr>

		<td><?php echo $order_id; ?></td>
		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
		<td><input type="hidden" name="income" value="<?php echo $destination; ?>" /><?php echo $destination; ?></td>
		<td><input type="hidden" name="date" value="<?php echo $dateAt; ?>" /><?php echo $dateAt; ?></td>
		<td><input type="hidden" name="category" value="<?php echo $charge; ?>" /><?php echo $charge; ?></td> 
		
	<td><input type='hidden' name='total_D' style="color:green" value='".$total_L."' /><p style="color:green"><?php echo $total_L; ?></p> </td>
	
	
		
			<td class="empty" width="100">
		<a data-placement="top" title="Click to View all Details" id="view<?php echo $order_id; ?>"  href="view_pay.php<?php echo '?id='.$order_id; ?>" class="btn btn-success"><i style="color:white" class="icon-eye-open icon-large"></i>&nbsp View</a>
		</td>	
		</tr>
	  <?php }
        }
        
	  ?>  
	
		</tbody>
	</table>
	</form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
				
                <div class="span9" id="2">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
						$month=date("m");
							$queryL= mysqli_query($conn,"select Sum(total_L),Count(*) from incomes where month='$month' ");
							if($queryL){
							$resultL = mysqli_fetch_array($queryL);
							$amountL=$resultL[0];
							$count = $resultL[1];
							}
							else {
							    $amountL=0;
							    $count=0;
							}
							$queryD= mysqli_query($conn,"select Sum(total_D) from incomes where month='$month' ");
							if($queryD){
						$res = mysqli_fetch_row($queryD);
						$amountD=$res[0];
							}
							else {
							   $amountD = 0;
							}
							
						 	
						?>
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Monthly Incomes</div>
                                <div class="muted pull-right">
									All Incomes: <span class="badge badge-info"><?php  echo $count;  ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
								<div class="span12" id="incTableDiv">
								<h2 id="noch">Month Incomes</h2>
									<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<form action="delete_income.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example2">
		
		<div class="pull-left">
			<span class='btn btn-info' >Total Incomes L.L : <?php echo "$amountL"; ?></span> 
			
			<span class='btn btn-info' >Total Incomes $$ : <?php echo "$amountD"; ?></span> 
		</div>
		<div class="pull-right">
			<a href="add_income.php" class='btn btn-success' ><i style="color:white" class="icon-plus icon-large"></i>&nbsp Add Income</a> 
			
			
		</div>
	<!--	<div class="pull-right">
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 
	</div>-->
<br><br>
		<thead>
	
		<tr>
					
					<th>Income ID</th>
					<th>Details</th>
					<th>Date</th>
					<th>Category</th>	
					<th>Amount</th>
					<th>Action</th>
				
		</tr>
	
		</thead>
		<tbody>
		<?php

		    $query2 = mysqli_query($conn,"select * from incomes where month='$month'");
		
        
        if($query2){
		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query2)){
        
		$inc_id =$row2['income_id'];
		$details =$row2['income'];
		$dateAt=$row2["date"];
	
		$cat=$row2["category"];
		$total_L=$row2['total_L']; 
		$total_D =$row2['total_D']; 
		$mon =$row2['month']; 
		?>
		<tr>
		<!--<td class="empty" width="30"><input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php //echo $inc_id; ?>"></td>-->
		
		<td><?php echo $inc_id; ?></td>
		<input type="hidden" name="income_id" value="<?php echo $inc_id; ?>" />
		<td><input type="hidden" name="income" value="<?php echo $details; ?>" /><?php echo $details; ?></td>
		<td><input type="hidden" name="date" value="<?php echo $dateAt; ?>" /><?php echo $dateAt; ?></td>
		<td><input type="hidden" name="category" value="<?php echo $cat; ?>" /><?php echo $cat; ?></td> 
		<?php 
		if($total_L == 0){
		    echo "<td><input type='hidden' name='total_D' value='".$total_D."' > "; echo $total_D; echo " </td>";
		}
		else{
		    echo "<td><input type='hidden' name='total_L' value='"; echo $total_L; echo "' > "; echo $total_L; echo " </td>";
		}
		?>
		
			<?php include('modal_delete.php'); ?>
		<td class="empty" width="200">
		<a data-placement="top" title="Click to Edit all Details" id="view<?php echo $inc_id; ?>" style="color:black"  href="edit_income.php<?php echo '?id='.$inc_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-edit icon-large"></i> Edit</a>
	<a data-toggle="modal" href="#income_delete" id="delete"  class="btn btn-danger"  name=""><i class="icon-trash icon-large"></i> Delete</a>		
		</td>
		</tr>
	  <?php }
        }
        
	  ?>  
	
		</tbody>
	</table>
	</form>
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