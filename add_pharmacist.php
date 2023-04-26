<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include('sidebar_pharmacists.php'); ?>
			<div class="span9" id="">
				<div class="row-fluid">
					<!-- block -->
					<div id="block_bg" class="block">
						<div class="navbar navbar-inner block-header">
							<div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Account</div>
							<div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a></div>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#return').tooltip('show');
									$('#return').tooltip('hide');
								});
							</script>
						</div>
						<div class="block-content collapse in">
							<form id="add_pharmacist" class="form-signin" method="post">

								<div class="span4">
									<label>FULL NAME</label>
									<input type="text" class="input-block-level" name="full_name" required>

									<label>PHARMACY NAME</label>
									<input type="text" class="input-block-level" name="pharmacy_name" required>

									<label>EMAIL</label>
									<input type="text" class="input-block-level" name="email" required>

									<label>PHONE NUMBER</label>
									<input type="tel" pattern="^(?:\+961|961|0)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81)\d{6}$" class="input-block-level" name="phone_number" required>

									<label>LOCATION</label>
									<input type="text" class="input-block-level" name="location" required>

									<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>
								</div>
							</form>

							<script>
								jQuery(document).ready(function($) {
									$("#add_pharmacist").submit(function(e) {
										e.preventDefault();
										var _this = $(e.target);
										var formData = $(this).serialize();
										$.ajax({
											type: "POST",
											url: "save_pharmacist.php",
											data: formData,
											success: function(html) {
												if (html == 'pharmacist_added') {
													$.jGrowl("Accout Successfully Added", {
														header: 'Account Added'
													});
													var delay = 2000;
													setTimeout(function() {
														window.location = 'pharmacists.php'
													}, delay);
												} else {
													$.jGrowl("Email is already used", {
														header: 'Account Adding Failed'
													});
													var delay = 2000;
												}
											},

										});
									});
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		?>
	</div>
	<?php include('script.php'); ?>
</body>

<?php } ?>

</html>