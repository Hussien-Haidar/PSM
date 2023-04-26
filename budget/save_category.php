<?php

		include('dbcon.php');
		include('session.php');
		
		
		$cat = $_POST['category'];
		$isExpense = $_POST['isExpense'];


		$stmt = $conn->prepare("insert into categories(category,isExpense)
		values 
		(?,?)")or die('Error, query failed');
		
		$stmt->bind_param("si",$cat,$isExpense);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Add New Category')")or die('Error, query failed');
		
		?>