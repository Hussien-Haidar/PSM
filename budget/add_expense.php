<?php include('session.php'); ?>
<?php include('header.php'); ?>

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
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Expense</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="expenses.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">						
						<form id="add_expense" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span4">
								
											<label>DETAILS:(تفاصيل)</label>
											<input type="text" class="input-block-level"  name="expense" placeholder="Item Name" required>
											<label>DATE</label>
											<input type="date" class="input-block-level"  name="date" required>
										</div>
						<!-- span 4 -->				
						<!-- span 4 -->				
						<div class="span4">
											
								<dt><label>PRICED L.L:(بل الليرة؟)</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=1 checked='true' onchange="priceLira(this)"> Yes </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=0 onchange="priceLira(this)"> No</label></dd>
											
											<div id="lira">
										    <label>PRICE(Lira) ( ل.ل)</label>
											<input type="number" step="1000" class="input-block-level"  name="priceLira"  value=0 placeholder="Price in Lira" >
											</div>
											<div id="usd" style="display:none">
											<label>PRICE($$) ( د.أ)</label>
											<input type="number" step="any" class="input-block-level"  name="priceUSD" value=0 placeholder="Price in USD" >
											</div>
									<br>
									
											
						</div>
						<!--end span 4 -->	
						<!-- span 4 -->	
						<div class="span4">
									
						<dt><label>CHOOSE CATEGORY</label></dt>
											<select name="category" id="cat">
											    <option value="Not Listed"> Not Listed </option>
											   <?php 
											   
											$result = mysqli_query($conn,"select * from categories where isExpense= 1")or die('Error ');
											while($row = mysqli_fetch_array($result)){
											$cat= $row['category'];
											$cat_id=$row["cat_id"];
									?>
								<option value="<?php echo $cat;?>"> <?php  echo $cat;?> </option>
									<?php }?>       
											</select>
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#add_expense").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "save_expense.php",
						data: formData,
						success: function(html){
						  
							$.jGrowl("Expense Successfully  Added", { header: 'Expense Added' });
							window.location = 'expenses.php';  
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