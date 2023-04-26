<?php include('session.php'); ?>
<?php include('header.php'); ?>

<body id="login">
	<div class="container">

		<?php
		$id = $_SESSION['id'];
		if ($_SESSION['role'] == 'administrator') {
			$query = mysqli_query($con, "select * from admins where id = '$id'");
			$row = mysqli_fetch_array($query);
		} else if ($_SESSION['role'] == 'pharmacist') {
			$query = mysqli_query($con, "select * from pharmacists where id = '$id'");
			$row = mysqli_fetch_array($query);
		}
		?>

		<form id="change_password" class="form-signin" method="post">
			<h3 class="form-signin-heading"><i class="icon-lock"></i> Change Password</h3>
			<input type="hidden" id="password" name="password" value="<?php echo $_SESSION['password'] ?>" placeholder="Current Password">
			<input type="password" id="active_password" name="active_password" placeholder="Current Password" required>
			<input type="password" id="new_password" name="new_password" placeholder="New Password" required>
			<input type="password" id="retype_password" name="retype_password" placeholder="Re-type Password" required>
			<br>
			<a href="javascript:history.go(-1)" title="Click to Return" class="btn btn-inverse">Back</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type="submit" data-placement="right" id="save" name="save" class="btn btn-success"><i class="icon-save icon-large"></i> Save</button>


			<script>
				jQuery(document).ready(function() {
					jQuery("#change_password").submit(function(e) {
						e.preventDefault();

						var password = jQuery('#password').val();
						var current_password = jQuery('#active_password').val();
						var new_password = jQuery('#new_password').val();
						var retype_password = jQuery('#retype_password').val();
						if (password != current_password) {
							$.jGrowl("Password does not match with your current password  ", {
								header: 'Change Password Failed'
							});
						} else if (new_password != retype_password) {
							$.jGrowl("Password does not match with your new password  ", {
								header: 'Change Password Failed'
							});
						} else if ((password == current_password) && (new_password == retype_password)) {
							var formData = jQuery(this).serialize();
							$.ajax({
								type: "POST",
								url: "change_password.php",
								data: formData,
								success: function(html) {
									$.jGrowl("Your password has been changed successfully", {
										header: 'Change Password Success'
									});
									var delay = 2000;
									setTimeout(function() {
										window.location = 'home.php'
									}, delay);
								}
							});
						}
					});
				});
			</script>
		</form>

		<?php
		if (isset($_POST["new_password"])) {
			if ($_SESSION['role'] == 'administrator') {
				$new_password  = $_POST['new_password'];
				mysqli_query($con, "update admins set password = '$new_password' where id = '$id'");
			} else if ($_SESSION['role'] == 'pharmacist') {
				$new_password  = $_POST['new_password'];
				mysqli_query($con, "update pharmacists set password = '$new_password' where id = '$id'");
			}
		}
		?>

	</div>

</body>

</html>