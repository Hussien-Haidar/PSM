<?php include('session.php'); ?>
<?php include('header.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                	<div class="span4" id=""></div>
				<div class="span4" id="">
				    <center>
			   <div class="row-fluid">
       <a href="orders.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i> Back</a>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Edit Profile </div>
                            </div>
							<?php
							$query = mysqli_query($conn,"select * from users where user_id = '$user_id'")or die(mysqli_error());
							$row = mysqli_fetch_array($query);
							?>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form id="update_profile" class="form-signin"  method="post">
									
					
								
										<div class="control-group">
                                          <div class="controls">
                                            <input name="name" value="<?php echo $row['name']; ?>" class="input focused" id="focusedInput" type="text" required>
                                          </div>
                                        </div>
										
									<!--	<div class="control-group">
                                          <div class="controls">
                                            <input name="password" value="<?php //echo $row['password']; ?>" class="input focused" id="focusedInput" type="text" required>
                                          </div>
                                        </div>-->
										<div class="control-group">
                                          <div class="controls">
                                            <input name="phone" value="<?php echo $row['phone']; ?>" class="input focused" id="focusedInput" type="text" required>
                                          </div>
                                        </div>
									    <div class="control-group">
                                          <div class="controls">
                                            <input name="email" value="<?php echo $row['email']; ?>" class="input focused" id="focusedInput" type="text" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <div class="controls">
                                            <input name="address" value="<?php echo $row['address']; ?>" class="input focused" id="focusedInput" type="text" required>
                                          </div>
                                        </div>
											<div class="control-group">
                                          <div class="controls">
												<button name="update" class="btn btn-success"><i class="icon-save icon-large"></i> Update</button>

                                          </div>
                                        </div>
                                </form>
								</div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    </center>	   			
				</div>
                <div class="span4" id=""></div>
            </div>
			<?php
			if (isset($_POST['update'])){

$name = $_POST['name'];
$phone= $_POST['phone'];
$email= $_POST['email'];
$address= $_POST['address'];
mysqli_query($conn,"update users set name ='$name', phone='$phone',email='$email',address='$address' where user_id = '$user_id' ")or die(mysqli_error());
echo "<script>$.jGrowl('Successfully  Updated', { header: 'Profile Edited' });
							window.location = 'orders.php';</script>";

}
			?>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>

</html>