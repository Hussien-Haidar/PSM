<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_categories.php'); ?>
                <div class="span4" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Category</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="categories.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">						
						<form id="add_category" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
								
											<label>CATEGORY</label>
											<input type="text" class="input-block-level"  name="category" placeholder="Category" required>
										
					
								<dt><label>Type</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isExpense" value=1 checked='true'> EXPENSES </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isExpense" value=0 > INCOMES</label></dd>
								<br>
						<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
											
						</div>
					
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#add_category").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "save_category.php",
						data: formData,
						success: function(html){
							$.jGrowl("Category Successfully  Added", { header: 'Category Added' });
							window.location = 'categories.php';  
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
		<?php include('footer.php'); ?>
        </div>
    
		<?php include('script.php'); ?>
    </body>	
</html>