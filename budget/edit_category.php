<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>
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
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Edit Category</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="categories.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">	
                            	<?php
						$query = mysqli_query($conn,"select * from categories where cat_id = '$get_id'");
						$row = mysqli_fetch_array($query);
						?>
						<form id="update_category" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
								<input type="hidden" name="category_id" value="<?php echo $get_id; ?>">
											<label>CATEGORY</label>
											<input type="text" class="input-block-level"  name="category" value="<?php echo $row['category']; ?>" required>
										
					
								<dt><label>Type</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isExpense" value=1 <?php if($row["isExpense"]==1) echo "checked"; ?>> EXPENSES </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isExpense" value=0 <?php if($row["isExpense"]==0) echo "checked"; ?>> INCOMES</label></dd>
								<br>
						<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Update </button>	
											
						</div>
					
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#update_category").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "update_category.php",
						data: formData,
						success: function(html){
							$.jGrowl("Category Successfully Updated", { header: 'Category Edited' });
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