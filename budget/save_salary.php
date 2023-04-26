<?php

		include('dbcon.php');
		include('session.php');
		
		
		$emp = $_POST['name'];
		$job = $_POST['job'];
		$sal=$_POST['salary'];


		$stmt = $conn->prepare("insert into salaries(employee,occupation,salary)
		values 
		(?,?,?)")or die('Error, query failed');
		
		$stmt->bind_param("ssd",$emp,$job,$sal);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Add New Employee')")or die('Error, query failed');
		
		?>