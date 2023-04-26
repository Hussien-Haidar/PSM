<div class="row-fluid">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Medicine</div>
		</div>

		<div class="block-content collapse in">
			<div class="span12">
				<form method="post" id="add_medicine">
					<div class="control-group">
						<div class="controls">
							<label>Name</label>
							<input class="input focused" name="name" id="focusedInput" type="text" placeholder="Name" required>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label>Quantity</label>
							<input class="input focused" name="amount" id="focusedInput" type="number" min="0" placeholder="Quantity" required>
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
		jQuery("#add_medicine").submit(function(e) {
			e.preventDefault();
			var formData = jQuery(this).serialize();
			$.ajax({
				type: "POST",
				url: "save_medicine.php",
				data: formData,
				success: function(html) {
					if (html == 'medicine_added') {
						$.jGrowl("Medicine successfully added", {
							header: 'Medicine Added'
						});
						var delay = 2000;
						setTimeout(function() {
							window.location = 'my_medicines.php'
						}, delay);

					} else {
						$.jGrowl("Medicine Already exists", {
							header: 'Cannot Add Medicine'
						});
						var delay = 3000;
					}
				},
			});
		});
	});
</script>