<?php
        require_once 'dbcon.php';
		include "session.php";
    	header("Content-Type: application/xls");    
    	header("Content-Disposition: attachment; filename=orders_list.xls");  
    	header("Pragma: no-cache"); 
    	header("Expires: 0");
    	
     
    	$output = "";
     
    	$output .="
    		<table>
    			<thead>
    				<tr>
    					<th>Order ID</th>
    					<th>Item</th>
						<th>Description</th>
    					<th>Fragile?</th>
    					<th>Price L.L</th>
    					<th>Price $$</th>
    					<th>Delivery Charge</th>
    					<th>Status</th>
    					<th>Assigned Rider</th>
    					<th>Sender Name</th>
    					<th>Sender Phone</th>
    					<th>Sender Email</th>
    					<th>Sender Address</th>
    					<th>Receiver Name</th>
    					<th>Receiver Email</th>
    					<th>Receiver Phone</th>
    					<th>Receiver Address</th>
    					
    				</tr>
    			<tbody>
    	";
     
    	$query = $conn->query("SELECT * FROM `orders` where sender_id= $user_id") or die("Error Select Query");
    	while($fetch = $query->fetch_array()){
     
    	$output .= "
    				<tr>
    					<td>".$fetch['order_id']."</td>
    					<td>".$fetch['title']."</td>
    					<td>".$fetch['description']."</td>
    					<td>".$fetch['fragile']."</td>
    					<td>".$fetch['uncharged_price']."</td>
    					<td>".$fetch['uncharged_price$']."</td>
    					<td>".$fetch['delivery_charge']."</td>
    					<td>".$fetch['status']."</td>
    					<td>".$fetch['assigned_rider']."</td>
    					<td>".$fetch['sender_name']."</td>
    					<td>".$fetch['sender_phone']."</td>
    					<td>".$fetch['sender_email']."</td>
    					<td>".$fetch['sender_address']."</td>
    					<td>".$fetch['receiver_name']."</td>
    					<td>".$fetch['receiver_email']."</td>
    					<td>".$fetch['receiver_phone']."</td>
    					<td>".$fetch['receiver_address']."</td>
    				</tr>
    	";
    	}
     
    	$output .="
    			</tbody>
     
    		</table>
    	";
     
    	echo $output;
     
     
    ?>