<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>
<style>
    td{
        text-align:center;
    }
</style>
    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_tracking.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
						<?php
							$query= mysqli_query($conn,"select * from orders where sender_id=$user_id")or die('Error, insert query failed');
							$count = mysqli_num_rows($query);
						 	
						?>
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Orders List</div>
                                <div class="muted pull-right">
									Number of Active Orders: <span class="badge badge-info"><?php  echo $count;  ?></span>
								</div>
                            </div>
                            <div class="block-content collapse in">
								<div class="span12" id="studentTableDiv">
								<h2 id="noch">Order List</h2>
										<form method="post">
	    <div style="overflow-x:auto;">
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		<div class="pull-right">
	</div>

	<br>
<!--	<a data-toggle="modal" href="#order_delete" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"></i> Delete</a>-->
	
		<thead>
		<tr>
					<th>Order ID</th>
					<th>Receiver</th>
					<th>Assigned At</th>
					<th>Driver Starts ?</th>
					<th>Started At</th>
				    <th>Delivered At</th>
				    <th>Status</th>
				    <th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		
	
		$query = mysqli_query($conn,"select * from orders where (status='ready to assign' or status='active' or status='delivered' or status='returned') AND sender_id=$user_id")or die('Error, insert query failed');
		
		while($row = mysqli_fetch_array($query)){
		    
		$id = $row['order_id'];
		?>
		<tr <?php  if($row['deliveredAt']!=null) echo "style='color:green';"?>>
		<td><?php echo $row['order_id'];?></td> 
		
		<td><?php echo $row['receiver_name'];?><br><?php echo $row['receiver_address'];?></td> 
		
		
		<td><?php echo substr($row['createdAt'],0,10); ?></td> 
		
		
		
		<td style="text-align:center"><?php if($row['has_started']==0) echo "<i class='icon-warning-sign icon-large' style='color:red'>"; else echo "<i class='icon-ok-sign icon-large' style='color:green'>"; ?></td> 
		
		<td><?php if($row['startedAt']==null) echo "<i class='icon-warning-sign icon-large' style='color:red'>"; else echo  $row["startedAt"];?></td>
			<td><?php if($row['deliveredAt']==null) echo "<i class='icon-warning-sign icon-large' style='color:red'>"; else echo  $row["deliveredAt"];?></td>

<td><?php echo $row['status']; ?></td>
		<td class="empty" width="140">
		    
		 <div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Action
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
      <li>
			<a data-placement='top' id='view $id' href="<?php echo "view_order.php?id=$id"; ?>" class='btn'><i class='icon-eye-open icon-large'></i> View</a></li>
			<!--<li>
			<?php /*if ($row['status']=="active"){
			echo ("<a data-placement='top' id='assign $id' href='cancel_order.php?id=$id' class='btn'><i class='icon-trash icon-large'></i> Cancel</a>");
			}*/
			
			?></li>-->
		
  </ul>
</div> 

	
			</td>
			
			
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
		</tr>
	<?php } ?>    
	
		</tbody>
	</table></div>
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