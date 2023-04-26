<?php

		include('dbcon.php');
		include('session.php');
		
		$exp_id=$_POST["expense_id"];
			
		$expense = $_POST['expense'];
		$date = $_POST['date'];
	   
		$cat = $_POST['category'];
		
		$isLira=$_POST["isLira"];
		if($isLira){
		$total_L = $_POST['total_L'];
		$total_D=0;
		}
		else{
		    $total_D=$_POST['total_D'];
		    $total_L=0;
		}
		
		$month=date('m', strtotime($date));
        
		
		$stmt = $conn->prepare("update expenses set expense = ? , date= ?, category = ?, total_L= ? , total_D = ? , month= ?
				
		where expense_id = $exp_id
		")or die('Error, query failed');
		
		$stmt->bind_param("sssddi",$expense,$date,$cat,$total_L,$total_D,$month);
		$stmt->execute();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Update Expense $exp_id')")or die('Error, query failed');
		
		?>