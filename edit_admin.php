<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include('sidebar_users.php'); ?>
			<div class="span3" id="">
				<?php include('edit_admin_form.php'); ?>
			</div>
		</div>
	</div>
</body>

<?php } ?>