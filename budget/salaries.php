<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_salaries.php'); ?>
			
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
					
							$query= mysqli_query($conn,"select Count(*) from salaries");
							if($query){
							$result = mysqli_fetch_row($query);
							
							$count = $result[0];
							}
							else {
							    $count=0;
							}
							
						 	
						?>
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> All Employees</div>
                                <div class="muted pull-right">
									Total Salaries : <span class="badge badge-info"><?php  echo $count;  ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
                                	<form action="delete_salary.php" method="post">
	 
								<div class="span12" id="salaryTableDiv">
								<h2 id="noch">Salaries</h2>
									<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<table cellpadding="0" cellspacing="0" border="0" class="table " id="example">
		

		<div class="pull-right">
			
		
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 <a href="add_salary.php" class='btn btn-success' >Add New Employee</a> 
	 
	</div>
<br><br>
		<thead>
	
		<tr>
					<th>Select</th>
					
					<th>Employee</th>
					<th>Occupation</th>
					<th>Salary</th>
					<th>Action</th>
				
		</tr>
	
		</thead>
		<tbody>
		<?php

		    $query2 = mysqli_query($conn,"select * from salaries");
		
if($query2){
		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query2)){

		$emp_id =$row2['emp_id'];

	    $name=$row2['employee'];
		$job=$row2["occupation"];
		$salary=$row2["salary"];
	
		?>
		<tr>
		<td class="empty" width="30"><input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $emp_id; ?>"></td>
		
	
		<input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>" />
		<td><input type="hidden" name="employee" value="<?php echo $name; ?>" /><?php echo $name; ?></td>
		<td><input type="hidden" name="job" value="<?php echo $job; ?>" /><?php  echo $job ?></td>
			<td><input type="hidden" name="salary" value="<?php echo $salary; ?>" /><?php  echo $salary ?></td>
		<td class="empty" width="180">
		    <?php include('modal_delete.php'); ?>
		<a data-placement="top" title="Click to Edit all Details" id="edit<?php echo $emp_id; ?>" style="color:black"  href="edit_salary.php<?php echo '?id='.$emp_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-edit icon-large"></i> Edit</a>
		
		<a data-toggle="modal" href="#salary_delete" id="delete"  class="btn btn-danger"  name=""><i class="icon-trash icon-large"></i> Delete</a>		
		</td>
		</tr>
	  <?php }
}
	  ?>  
	
		</tbody>
	</table>
</div>
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