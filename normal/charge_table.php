	<?php include('dbcon.php'); ?>
    <?php include('session.php'); ?>
	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		<div class="pull-right">
	 <a href="#" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print List</a> 

	</div>

		<thead>
		<tr>
					<th>Governorate ID</th>
					<th>Governorate</th>
					
					<th>Image</th>
					<th>Charge (L.L)</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$query = mysqli_query($conn,"select * from charge ");
		while($row = mysqli_fetch_array($query)){
		$id = $row['governorate_id'];
		?>
		<tr>
		<td><?php echo $row['governorate_id'];?></td> 
		<td><?php echo $row['governorate'];?></td> 
		
		<td><img src="<?php echo $row['image']; ?>" width="90px" height="90px"></td>
		<td><?php echo $row['charge_lira']; ?></td> 
	
		</tr>
	<?php } ?>    
	
		</tbody>
	</table>
	</form>