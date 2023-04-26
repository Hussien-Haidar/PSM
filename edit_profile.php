<?php include('session.php'); ?>
<?php if($_SESSION['role']=='admin') echo 'access denied'; else { ?>
<?php include('header.php'); ?>
<?php $id = $_SESSION['id']; ?>

<body>
	<?php include('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3" id="">
				<?php include('edit_profile_form.php'); ?>
			</div>
		</div>
	</div>
</body>

<?php } ?>