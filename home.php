<?php
include('header.php');
?>

<body id="login">
	<div class="container">
		<?php include('navbar_index.php'); ?>
		<img src="img/images/ban.jpeg" class="img-polaroid">
		<form id="login_form" class="form-signin" method="post">
			<h3 class="form-signin-heading"><i class="icon-lock"></i> Please Login</h3>
			<input type="text" class="input-block-level" id="usernmae" name="username" placeholder="Username" required>
			<input type="password" class="input-block-level" id="password" name="password" placeholder="Password" required>
			<button data-placement="top" title="Click to Login" id="login1" name="login" class="btn btn-success" type="submit"><i class="icon-signin icon-large"></i>Sign in</button>
			<a href="forgot_password.php" class="pull-right"><b>Forgot Password?</b></a>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#login1').tooltip('show');
					$('#login1').tooltip('hide');
				});
			</script>
		</form>

		<script>
			jQuery(document).ready(function() {
				jQuery("#login_form").submit(function(e) {
					e.preventDefault();
					var formData = jQuery(this).serialize();
					$.ajax({
						type: "POST",
						url: "login.php",
						data: formData,
						success: function(html) {
							if (html == 'true_admin') {
								$.jGrowl("Loading Please Wait......", {
									sticky: true
								});
								$.jGrowl("Welcome to Pharmacist System Management", {
									header: 'Access Granted'
								});
								var delay = 1000;
								setTimeout(function() {
									window.location = 'pharmacists.php'
								}, delay);
							} else
							if (html == 'true_pharmacist') {
								$.jGrowl("Loading Please Wait......", {
									sticky: true
								});
								$.jGrowl("Welcome to Pharmacist System Management", {
									header: 'Access Granted'
								});
								var delay = 1000;
								setTimeout(function() {
									window.location = 'my_medicines.php'
								}, delay);
							} else if (html == 'disabled_pharmacist') {
								$.jGrowl("Your Account has been disabled", {
									header: 'Disabled Account'
								});
							} else {
								$.jGrowl("Please Check your username and Password", {
									header: 'Login Failed'
								});
							}
						}
					});
					return false;
				});
			});
		</script>

	</div>
	<?php include('script.php'); ?>
</body>
</html>
