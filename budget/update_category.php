<?php

		include('dbcon.php');
		include('session.php');
		
		$cat_id=$_POST["category_id"];
			
		$isExpense = $_POST['isExpense'];
	   
		$cat = $_POST['category'];
		
	
		$stmt = $conn->prepare("update categories set category = ? , isExpense= ?
				
		where cat_id = $cat_id
		")or die('Error, query failed');
		
		$stmt->bind_param("si",$cat,$isExpense);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Update Category $cat_id')")or die('Error, query failed');
		
		?>