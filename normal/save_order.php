<?php
		include('dbcon.php');
		include('session.php');
		
		$title = $_POST['item'];
		$desc = $_POST['description'];
		$isFragile = $_POST['fragile'];
		$isLira = $_POST['isLira'];
		
	    if(isset($_POST['priceLira'])){
		$priceLira = $_POST['priceLira'];
	    }
	    else $priceLira=0;
	    
	    if(isset($_POST['priceUSD'])){
		$priceUSD = $_POST['priceUSD'];
	    }
	    else $priceUSD=0;
		
		$q1 = mysqli_query($conn,"select * from users where user_id=$user_id ")or die('Error, query failed');
		$row = mysqli_fetch_array($q1);
		$sen_id=$row["user_id"];
		$sen_name= $row['name'];
		$sen_address= $row['address'];
		$sen_email = $row['email'];
		$sen_phone = $row['phone'];
		
		$rider = 0;
		$status="pending";
		
		$route = $_POST['route'];
		$q2 = mysqli_query($conn,"select * from charge where governorate_id=$route ")or die('Error, query failed');
		$row2 = mysqli_fetch_array($q2);
		$charge=$row2["charge_lira"];
		
		$rec_name = $_POST['rec_name'];
		$rec_address = $_POST['rec_address'];
		$rec_email = "not mentioned";
		if(isset($_POST['rec_email']) && $_POST['rec_email']!=""){
		$rec_email = $_POST['rec_email'];
	    }
	    
		$rec_phone = $_POST['rec_tel'];
		
		$stmt = $conn->prepare("insert into orders(title,description,fragile,pricing_lira,uncharged_price,uncharged_price$,delivery_charge,assigned_rider,sender_id,sender_email,
		sender_phone,sender_address,sender_name,receiver_email,receiver_phone,receiver_address,receiver_name,status,route
		) 
		values 
		(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")or die('Error, query failed');
		
		$stmt->bind_param("ssiidddiissssssssss",$title,$desc,$isFragile,$isLira,$priceLira,$priceUSD,$charge,$rider,$sen_id,$sen_email,$sen_phone,$sen_address,$sen_name,$rec_email,
		$rec_phone,$rec_address,$rec_name,$status,$route);
		$stmt->execute();
		mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Add a New Order from $sen_name to $$rec_name')")or die('Error, query failed');
