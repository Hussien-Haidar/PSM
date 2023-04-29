<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'pharmacist') echo 'access denied';
else { ?>
	<?php include('header.php'); ?>

	<?php $get_id = $_GET['id']; ?>

	<body>
		<?php include('navbar.php'); ?>
		<div class="container-fluid">
			<div class="row-fluid">
				<?php include('sidebar_medicines.php'); ?>
				<div class="span9" id="">
					<div class="row-fluid">
						<!-- block -->
						<div id="block_bg" class="block">
							<div class="navbar navbar-inner block-header">
								<div class="muted pull-right">
									<a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a>
								</div>
							</div>
							<div class="block-content collapse in">
								<?php
								$query = mysqli_query($con, "SELECT medicines.*, pharmacists.*, medicines.created_at AS med_created_at, pharmacists.created_at AS pharm_created_at
							FROM medicines
							JOIN pharmacists ON medicines.id_pharmacist = pharmacists.id 
							WHERE medicines.id = '$get_id'");
								$row = mysqli_fetch_array($query);

								?>
								<div class="alert alert-success">MEDICINE DETAILS</div>
								<div class="span5">
									Name: <strong><?php echo $row['name']; ?></strong>
									<hr>

									Pharmacist: <strong><?php echo $row['full_name']; ?></strong>
									<hr>

									Phone: <strong><?php echo '+961' . $row['phone_number']; ?></strong>
									<hr>

									Email: <strong><?php echo $row['email']; ?></strong>
									<hr>

									Loaction: <strong><?php echo $row['location']; ?></strong>
									<hr>

									Status: <strong <?php if ($row['status'] == 'disabled') echo "style='color: red'"; ?>>
										<?php if ($row['status'] == 'verified') echo 'Active';
										else echo 'Not Active'; ?>
									</strong>
								</div>
								<div class="span5">
									Pharmacy: <strong><?php echo $row['pharmacy_name']; ?></strong>
									<hr>

									Date Created: <strong><?php echo $row['med_created_at']; ?></strong>
									<hr>
								</div>
							</div>
						</div>
						<!-- /block -->
					</div>
				</div>
			</div>
		</div>
		<?php include('script.php'); ?>
	</body>

<?php } ?>

</html>