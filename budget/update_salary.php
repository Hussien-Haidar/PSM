<?php

		include('dbcon.php');
		include('session.php');
		
		$emp_id=$_POST["salary_id"];
			
		$name = $_POST['name'];
	   
		$job = $_POST['job'];
		
		$sal=$_POST["salary"];
	
		$stmt = $conn->prepare("update salaries set employee = ? , occupation = ? , salary= ? 
				
		where emp_id = $emp_id
		")or die('Error, query failed');
		
		$stmt->bind_param("ssd",$name,$job,$sal);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Update Salary for $emp_id')")or die('Error, query failed');
		
		?>