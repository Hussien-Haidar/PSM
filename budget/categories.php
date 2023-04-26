<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_categories.php'); ?>
			
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
					
							$query= mysqli_query($conn,"select Count(*) from categories");
							if($query){
							$resultL = mysqli_fetch_row($query);
							
							$count = $resultL[0];
							}
							else {
							    $amountL=0;
							    $count=0;
							}
							
						 	
						?>
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> All Categories</div>
                                <div class="muted pull-right">
									Total Categories : <span class="badge badge-info"><?php  echo $count;  ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
                                	<form action="delete_category.php" method="post">
	 
								<div class="span12" id="studentTableDiv">
								<h2 id="noch">Categories</h2>
									<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    	<table cellpadding="0" cellspacing="0" border="0" class="table " id="example">
		

		<div class="pull-right">
			<a href="add_category.php" class='btn btn-success' >Add New Category</a> 
			
			
		</div>
	<!--	<div class="pull-right">
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 
	 
	</div>-->
<br><br>
		<thead>
	
		<tr>
					<th>Select</th>
					
					<th>Category</th>
					<th>Type</th>
					<th>Action</th>
				
		</tr>
	
		</thead>
		<tbody>
		<?php

		    $query2 = mysqli_query($conn,"select * from categories ORDER BY isExpense");
		
if($query2){
		//$query = mysqli_query($conn,"select * from orders where status = 'delivered' ");
		while($row2= mysqli_fetch_array($query2)){

		$cat_id =$row2['cat_id'];

	    $isExpense=$row2['isExpense'];
		$cat=$row2["category"];
	
		?>
		<tr>
		<td class="empty" width="30"><input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $cat_id; ?>"></td>
		
	
		<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
		<td><input type="hidden" name="category" value="<?php echo $cat; ?>" /><?php echo $cat; ?></td>
		<td><input type="hidden" name="type" value="<?php echo $isExpense; ?>" /><?php if($isExpense) echo "Expenses"; else echo "Incomes"; ?></td>
		<?php include('modal_delete.php'); ?>
		<td class="empty" width="200">
		<a data-placement="top" title="Click to Edit all Details" id="edit<?php echo $cat_id; ?>" style="color:black"  href="edit_category.php<?php echo '?id='.$cat_id; ?>" class="btn btn-warning"><i style="color:white" class="icon-edit icon-large"></i> Edit</a>
		
	<a data-toggle="modal" href="#category_delete" id="delete"  class="btn btn-danger"  name=""><i class="icon-trash icon-large"></i> Delete</a>	
				
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