<div class="row-fluid">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Administrator</div>
		</div>

		<div class="block-content collapse in">
			<div class="span12">
				<form method="post" id="add_admin">
					<div class="control-group">
						<div class="controls">
							<label>USERNAME</label>
							<input class="input focused" name="username" id="focusedInput" type="text" placeholder="Administrator" required>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label>FULL NAME</label>
							<input class="input focused" name="full_name" id="focusedInput" type="text" placeholder="Administrator" required>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label>Email</label>
							<input class="input focused" name="email" id="focusedInput" type="email" placeholder="Email" required>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label>PASSWORD</label>
							<input class="input focused" name="password" id="focusedInput" type="text" placeholder="Password" required>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button data-placement="right" title="Click to Save" id="save" name="save" class="btn btn-inverse"><i class="icon-save icon-large"></i> Save</button>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#save').tooltip('show');
									$('#save').tooltip('hide');
								});
							</script>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		jQuery("#add_admin").submit(function(e) {
			e.preventDefault();
			var formData = jQuery(this).serialize();
			$.ajax({
				type: "POST",
				url: "save_admin.php",
				data: formData,
				success: function(html) {
					if (html == 'admin_added') {
						$.jGrowl("New Admin Successfully Added", {
							header: 'Administrator Added'
						});
						var delay = 2000;
						setTimeout(function() {
							window.location = 'users.php'
						}, delay);

					} else {
						$.jGrowl("Username or Email is Already Used", {
							header: 'Cannot Add Administrator'
						});
						var delay = 4000;
					}
				},
			});
		});
	});
</script>