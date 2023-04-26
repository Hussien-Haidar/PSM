<?php include('session.php'); ?>
<?php if($_SESSION['role']=='admin') echo 'access denied'; else { ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<?php include('sidebar_my_medicines.php'); ?>
			<div class="span3" id="">
				<?php include('edit_medicine_form.php'); ?>
			</div>
		</div>
	</div>
</body>

<?php } ?>