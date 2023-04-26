<?php

		include('dbcon.php');
		include('session.php');
		
		
		$expense = $_POST['expense'];
		$date = $_POST['date'];
	   
		$cat = $_POST['category'];
		$total_L = $_POST['priceLira'];
		$total_D=$_POST['priceUSD'];
		$month = date('m', strtotime($date));
        

		$stmt = $conn->prepare("insert into expenses(expense,date,month,category,total_L,total_D)
		values 
		(?,?,?,?,?,?)")or die('Error, query failed');
		
		$stmt->bind_param("ssisdd",$expense,$date,$month,$cat,$total_L,$total_D);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Add New Expense')")or die('Error, query failed');
		
		?>