<?php
		include('dbcon.php');
		include('session.php');
		
		$order_id = $_POST['order_id'];
		$title = $_POST['item'];
		$des = $_POST['description'];
		$fragile = $_POST['fragile'];
		$isLira = $_POST['isLira'];
		$priceLira = $_POST['priceLira'];
		$priceUSD = $_POST['priceUSD'];
		$route = $_POST['route'];
		
		$q2 = mysqli_query($conn,"select * from charge where governorate_id=$route ")or die('Error, query failed');
		$row2 = mysqli_fetch_array($q2);
		$charge=$row2["charge_lira"];

		$q1 = mysqli_query($conn,"select * from users where user_id=$user_id ")or die('Error, query failed');
		$row = mysqli_fetch_array($q1);
		$sen_id=$row["user_id"];
		$sen_name= $row['name'];
		$sen_address= $row['address'];
		$sen_email = $row['email'];
		$sen_phone = $row['phone'];
		
		$rec_name = $_POST['rec_name'];
		$rec_address = $_POST['rec_address'];
		$rec_email ="not mentioned";
		if(isset($_POST['rec_email']) && $_POST['rec_email']!=""){
		$rec_email = $_POST['rec_email'];
	    }
		$rec_phone = $_POST['rec_phone'];
		
		$stmt = $conn->prepare("update orders set title = ?, description =?,
		fragile =?,
		pricing_lira =?,
		uncharged_price=?,
		uncharged_price$ =?,
		delivery_charge =?,
		sender_name =?,sender_address =?,
		sender_phone =?,
		sender_email =?,
		route =?, 
		receiver_name =?, 
		receiver_address =?,
	    receiver_email =?, 
		receiver_phone =?		
		where order_id = $order_id");
		
		$stmt->bind_param("ssiidddsssssssss",$title,$des,$fragile,$isLira,$priceLira,$priceUSD,$charge,$sen_name,$sen_address,$sen_phone,$sen_email,$route,$rec_name,
		$rec_address,$rec_email,$rec_phone)or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
		$stmt->execute();
		$stmt->close();
		
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Updated Order $order_id')")or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
