<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_orders.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Order</div>
                                <div class="muted pull-right"><a href="orders.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
                            </div>
                            <div class="block-content collapse in">
						<?php
						$query = mysqli_query($conn,"select * from orders where order_id = '$get_id'");
						$row = mysqli_fetch_array($query);
						?>
						<form id="update_order" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span6">
										<input type="hidden" value="<?php echo $row['order_id']; ?>" class="input-block-level"  name="order_id" required>
										
									        <label>ITEM NAME:</label>
											<input type="text" class="input-block-level"  name="item" value="<?php echo $row['title']; ?>" required>
												<label>DESCRIPTION:</label>
											<input type="text" class="input-block-level"  name="description"     value="<?php echo $row['description']; ?>"     required>
										
											<label>FRAGILE?</label>
													<dd><label class="radio-inline"><input type="radio" name="fragile" value=1<?php if($row['fragile']) echo" checked='true'";?>> Yes </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="fragile" value=0<?php if($row['fragile']==0) echo" checked='true'";?>> No</label></dd>
									<dt><label>Can be Priced in L.L:</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=1 <?php if($row['pricing_lira']) echo" checked='true'";?>> Yes </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isLira" <?php if($row['pricing_lira']==0) echo" checked='true'";?> value=0> No</label></dd>
											
										    	<div id="lira">
										    <label>ORIGINAL PRICE(Lira)</label>
											<input type="number" step="any" class="input-block-level"  name="priceLira"     value="<?php echo $row['uncharged_price']; ?>">
											</div>
											<label>EQUIVALENT PRICE($$)</label>
											<input type="number" step="any"  class="input-block-level"  name="priceUSD"    value="<?php echo $row['uncharged_price$']; ?>">
											
										</div>
						<!-- span 4 -->				
					
						<!-- span 4 -->	
						<div class="span6">
							<label>DESTINATION GOVERNORATE (المحافظة):</label>
											
												<select name="route">
												<?php 
											$q2 = mysqli_query($conn,"select * from charge ");
											while($row2 = mysqli_fetch_array($q2)){
											$gov_id = $row2['governorate_id'];
											$gov=$row2['governorate'];
											$charge=$row2['charge_lira'];
									?>
								<option value="<?php echo $gov_id;?>"> <?php  echo $gov.' ('.$charge.' L.L)';?> </option>
									<?php }?>
									</select>		
							<label>RECEIVER NAME:</label>
							<input type="text" class="input-block-level"  name="rec_name" value="<?php echo $row['receiver_name']; ?>" required>
							<label>RECEIVER ADDRESS:</label>
							<input type="text" class="input-block-level"  name="rec_address" value="<?php echo $row['receiver_address']; ?>" required>
						    
							<label>RECEIVER EMAIL:</label>
							<input type="email" class="input-block-level"  name="rec_email" value="<?php echo $row['receiver_email']; ?>" >
							<label>RECEIVER PHONE:</label>
							<input type="phone" class="input-block-level"  name="rec_phone"  onkeydown='return(event.which >= 48 && event.which <= 57)
											|| event.which ==8 || event.which == 46' maxlength ="13" value="<?php echo $row['receiver_phone']; ?>" required>
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						<div class="span12"><hr></div>		
							</form>			
								<script>
									jQuery(document).ready(function($){
										$("#update_order").submit(function(e){
											e.preventDefault();
											var _this = $(e.target);
											var formData = $(this).serialize();
											$.ajax({
												type: "POST",
												url: "update_order.php",
												data: formData,
												success: function(html){
													$.jGrowl("Orders Successfully  Updated", { header: 'Order Updated' });
													
													window.location ='orders.php?eraseCache=true';
												}
											});
										});
									});
									 $(document).on('click', 'input[name="isLira"]', function() {
    if($(this).val()==0){
        document.getElementById("lira").style.display = 'none';
    }
    else{
        document.getElementById("lira").style.display = 'inline';
    }
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