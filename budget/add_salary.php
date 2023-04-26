<?php include('session.php'); ?>
<?php include('header.php'); ?>

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
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Employee</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="salaries.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">						
						<form id="add_salary" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
								
											<label>EMPLOYEE:(الموظف)</label>
											<input type="text" class="input-block-level"  name="name" placeholder="Employee Name" required>
											<label>OCCUPATION</label>
											<input type="text" class="input-block-level"  name="job" required>
											
											<label>SALARY</label>
											</label>
											<input type="number" class="input-block-level"  min=0 name="salary" required>
									
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#add_salary").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "save_salary.php",
						data: formData,
						success: function(html){
							$.jGrowl("Salary Successfully  Added", { header: 'Employee Added' });
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