<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_salaries.php'); ?>
                <div class="span4" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Edit Employee</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="salaries.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
						    <?php
						$query = mysqli_query($conn,"select * from salaries where emp_id = '$get_id'");
						$row = mysqli_fetch_array($query);
						?>
                            <div class="block-content collapse in">						
						<form id="edit_salary" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
								<input type="hidden" name="salary_id" value="<?php echo $get_id; ?>" >
											<label>EMPLOYEE:(الموظف)</label>
											<input type="text" class="input-block-level"  name="name" value="<?php echo $row['employee'];?>" required>
											<label>OCCUPATION</label>
											<input type="text" class="input-block-level"  name="job" value="<?php echo $row['occupation']; ?>" required>
											
											<label>SALARY</label>
											</label>
											<input type="number" class="input-block-level"  name="salary" value="<?php echo $row['salary'];?>" required>
									
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#edit_salary").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "update_salary.php",
						data: formData,
						success: function(html){
							$.jGrowl("Salary Successfully  Updated", { header: 'Employee Updated' });
							window.location = 'salaries.php';  
						},
				
					});
				});
			});
			</script>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
		<?php //include('footer.php'); ?>
        </div>
      
		<?php include('script.php'); ?>
    </body>	
</html>