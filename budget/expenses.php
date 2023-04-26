<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_expenses.php'); ?>
                <div class="span9" id="">
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
		$month=$_POST['month'];
 
		/*$query=mysqli_query($conn, "SELECT * FROM `expenses` WHERE `category`='$category'") or die(mysqli_error());
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
	else $month=date("m");
			
			?>
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
						
							$queryL= mysqli_query($conn,"select Sum(total_L),Count(*) from expenses where month='$month' ");
							if($queryL){
							$resultL = mysqli_fetch_array($queryL);
							$amountL=$resultL[0];
							$count = $resultL[1];
							}
							else {
							    $amountL=0;
							    $count=0;
							}
							$queryD= mysqli_query($conn,"select Sum(total_D) from expenses where month='$month' ");
							if($queryD){
						$res = mysqli_fetch_row($queryD);
						$amountD=$res[0];
							}
							else {
							   $amountD = 0;
							}
							
	$q = mysqli_query($conn,"select Sum(salary) from salaries ");
	$r=mysqli_fetch_array($q);
	$total_salaries=0;
	$total_salaries=$r[0];

						 	
						?>
					
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Monthly Expenses</div>
                                	
                                <div class="muted pull-right">
									All Expenses: <span class="badge badge-info"><?php  echo $count; ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
								<div class="span12" id="studentTableDiv">
								<h2 id="noch">Month Expenses</h2>
									<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form action="delete_expense.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		
		<div class="pull-left">
		    	
			<span class='btn btn-info' >Total Expenses L.L : <?php echo $amountL+$total_salaries; ?></span> 
			
				<span class='btn btn-info' >Total Expenses $$ : <?php echo "$amountD"; ?></span> 
		</div>
		<div class="pull-right">
			<a href="add_expense.php" class='btn btn-success' >Add Expenses</a> 
	
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 
	</div>
<br><br>
		<thead>
	
		<tr>
					
					<th>Expense ID</th>
					<th>Details</th>
					<th>Date</th>
					<th>Category</th>	
					<th>Amount</th>
					<th>Action</th>
				
		</tr>
	
		</thead>
		<tbody>
		    <tr>
		        <td>0</td>
		        <td>Total Salaries</td>
		        <td>Month <?php echo $month; ?></td>
		        <td>Salaries</td>
		        <td><?php echo $total_salaries; ?></td>
		        <td>
	<a data-placement="top" title="View Salaries" id="editSalaries"   href="salaries.php" class="btn btn-success"><i style="color:white" class="icon-edit icon-large"></i> Edit Salaries</a>
		
		        </td>
		    </tr>
		<?php

		    $query2 = mysqli_query($conn,"select * from expenses where month='$month'");
		
if($query2){
		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query2)){

		$exp_id =$row2['expense_id'];
		$details =$row2['expense'];
		$dateAt=$row2["date"];
	
		$cat=$row2["category"];
		$total_L=$row2['total_L']; 
		$total_D =$row2['total_D']; 
		$mon =$row2['month']; 
		?>
		<tr>
	
		
		<td><?php echo $exp_id; ?></td>
		<input type="hidden" name="expense_id" value="<?php echo $exp_id; ?>" />
		<td><input type="hidden" name="expense" value="<?php echo $details; ?>" /><?php echo $details; ?></td>
		<td><input type="hidden" name="date" value="<?php echo $dateAt; ?>" /><?php echo $dateAt; ?></td>
		<td><input type="hidden" name="category" value="<?php echo $cat; ?>" /><?php echo $cat; ?></td> 
		<td><input type="hidden" name="total_L" value="<?php echo $total_L; ?>" /><?php echo $total_L; ?></td> 
		<?php include('modal_delete.php'); ?>
		<td class="empty" width="200">
		
		<a data-placement="top" title="Click to Edit all Details" id="edit<?php echo $exp_id; ?>" style="color:black"  href="edit_expense.php<?php echo '?id='.$exp_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-edit icon-large"></i> Edit</a>
		<a data-toggle="modal" href="#expense_delete" id="delete"  class="btn btn-danger"  name=""><i class="icon-trash icon-large"></i> Delete</a>	
		</td>
		</tr>
	  <?php }
}
	  ?>  
	
		</tbody>
	</table></form>
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