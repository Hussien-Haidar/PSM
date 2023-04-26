<?php include('session.php'); ?>
<?php include('header.php'); ?>

  <body id="login">
    <div class="container">
		
	<?php
			$query = mysqli_query($conn,"select * from users where user_id = '$session_id'")or die(mysqli_error());
			$row = mysqli_fetch_array($query);
	?>		
	
      <form id="change_password" class="form-signin" method="post">
        <h3 class="form-signin-heading"><i class="icon-lock"></i> Change Password</h3>
		<input type="hidden" id="password" name="password" value="<?php echo decrypt($row['password']); ?>" >
		<input type="password" id="active_password" name="active_password"  placeholder="Current Password" required>
        <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
		<input type="password" id="retype_password" name="retype_password" placeholder="Re-type Password" required>
		<br>
		<a href="orders.php" title="Click to Edit"  class="btn btn-inverse">Back</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
       <!-- <button  type="submit" data-placement="right" id="save" name="save" class="btn btn-success"><i class="icon-save icon-large"></i> Save</button>-->
		<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	

			<script>
			jQuery(document).ready(function(){
			jQuery("#change_password").submit(function(e){
					e.preventDefault();
						
						var password = jQuery('#password').val();
					    
						var current_password = jQuery('#active_password').val();
						var new_password = jQuery('#new_password').val();
						var retype_password = jQuery('#retype_password').val();
						if (password != current_password)
						{
						$.jGrowl("Password does not match with your current password  ", { header: 'Change Password Failed' });
						}else if  (new_password != retype_password){
						$.jGrowl("Password does not match with your new password  ", { header: 'Change Password Failed' });
						}else if ((password == current_password) && (new_password == retype_password)){
					var formData = jQuery(this).serialize();
					$.ajax({
						type: "POST",
						url: "change_password.php",
						data: formData,
						success: function(html){
						$.jGrowl("Your password has been changed successfully", { header: 'Change Password Success' });
						var delay = 2000;
							setTimeout(function(){ window.location = '../index.php'  }, delay);  
						}
					});
					}
				});
			});
			</script>
			</form>
			 <?php
if(isset($_POST["new_password"])){
$new_password  = encrypt($_POST['new_password']);
 
$stmt = $conn->prepare("update users set password = ? where user_id = '$session_id' AND status='normal'");
		
$stmt->bind_param("s",$new_password);
$stmt->execute();
mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Updated his Account Password)");		
}
 ?>
			
    </div>
<?php include('footer.php'); ?>
<?php include('script.php'); ?>
  </body>
</html>