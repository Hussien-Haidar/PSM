<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_expenses.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Expense</div>
                                <div class="muted pull-right"><a href="expenses.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
                            </div>
                            <div class="block-content collapse in">
						<?php
						$query = mysqli_query($conn,"select * from expenses where expense_id = '$get_id'");
						$row = mysqli_fetch_array($query);
						?>
						<form id="update_expense" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
										<input type="hidden" value="<?php echo $row['expense_id']; ?>" class="input-block-level"  name="expense_id" required>
										
									        <label>DETAILS:</label>
											<input type="text" class="input-block-level"  name="expense" value="<?php echo $row['expense']; ?>" required>
												<label>DATE:</label>
											<input type="date" class="input-block-level"  name="date"     value="<?php echo $row['date']; ?>"     required>
									
								
										</div>
						<!-- span 4 -->				
						<!-- span 4 -->				
						                <div class="span4">
											<dt><label>CAN BE PRICED L.L:</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=1 <?php if($row['total_L']>0) echo" checked='true'";?>> Yes </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isLira" <?php if($row['total_L']==0) echo" checked='true'";?> value=0> No</label></dd>
												<div id="lira" style="<?php if($row['total_L']>0) echo 'display:inline';else echo 'display:none'; ?>">
										    <label>PRICE(Lira)</label>
											<input type="number" step="any" class="input-block-level"  name="total_L"     value="<?php echo $row['total_L']; ?>">
											</div>
											<div id="usd" style="<?php if($row['total_L']>0) echo 'display:none';else echo 'display:inline'; ?>">
										<label>PRICE($$)</label>
											<input type="number" step="any"  class="input-block-level"  name="total_D"    value="<?php echo $row['total_D']; ?>">
											</div>
						</div>
						<!--end span 4 -->	
						<!-- span 4 -->	
						<div class="span4">
									
							<dt><label>CHOOSE CATEGORY:</label></dt>
											<select name="category" id="category">
											     <option value="<?php echo $row["category"];?>"> <?php  echo $row["category"];?> </option>
											    <option value="Not Listed"> Not Listed </option>
											   <?php 
											   
											$cate = mysqli_query($conn,"select * from categories where isExpense= 1")or die('Error ');
											while($row3 = mysqli_fetch_array($cate)){
											$cat= $row3['category'];
									?>
								<option value="<?php echo $cat;?>"> <?php  echo $cat;?> </option>
									<?php }?>       
											</select>
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						<div class="span12"><hr></div>		
							</form>			
								<script>
									jQuery(document).ready(function($){
										$("#update_expense").submit(function(e){
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "update_expense.php",
												data: formData,
												success: function(html){
													$.jGrowl("Expense Successfully  Updated", { header: 'Expense Updated' });
													
													window.location ='expenses.php';
												}
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
         <script>
    $(document).on('click', 'input[name="isLira"]', function() {
    if($(this).val()==0){
        document.getElementById("lira").style.display = 'none';
         document.getElementById("usd").style.display = 'inline';
    }
    else{
        document.getElementById("lira").style.display = 'inline';
        document.getElementById("usd").style.display = 'none';
    }
});
         
        </script>
		<?php include('script.php'); ?>
    </body>	
</html>