<?php include('session.php'); ?>
<?php include('header.php'); ?>

    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_add_order.php'); ?>
                <div class="span9" id="">
                     <div class="row-fluid">
                        <!-- block -->
                        <div  id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"></i> Add Order</div>
                                <div class="muted pull-right"><a id="return" data-placement="left" title="Click to Return" href="orders.php"><i class="icon-arrow-left icon-large"></i> Back</a></div>
																<script type="text/javascript">
																$(document).ready(function(){
																	$('#return').tooltip('show');
																	$('#return').tooltip('hide');
																});
																</script>                          
						    </div>
                            <div class="block-content collapse in">						
						<form id="add_order" class="form-signin" method="post">
						<!-- span 4 -->
										<div class="span6">
								
											<label>ITEM:(الاسم)</label>
											<input type="text" class="input-block-level"  name="item" placeholder="Item Name" required>
											<label>DESCRIPTION:(الوصف)</label>
											<input type="text" class="input-block-level"  name="description"     placeholder="Description"     required>
											
											<label>FRAGILE?(قابل للكسر)</label>
												<dd><label class="radio-inline"><input type="radio" name="fragile" value=1 checked='true'> Yes (نعم)</label></dd>
											<dd><label class="radio-inline"><input type="radio" name="fragile" value=0> No (لا)</label></dd>
											
											<dt><label>Can be Priced in L.L:(مسَعر بل الليرة؟)</label></dt>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=1 checked='true'> Yes </label></dd>
											<dd><label class="radio-inline"><input type="radio" name="isLira" value=0> No</label></dd>
											<div id="lira">
										    <label>ORIGINAL PRICE(Lira) (سعر القطعة ل.ل)</label>
											<input type="number" step="any" class="input-block-level"  name="priceLira" value=0 placeholder="Price in Lira" >
											</div>
											<label>EQUIVALENT PRICE($$) (سعر القطعة د.أ)</label>
											<input type="number" step="any" class="input-block-level"  name="priceUSD" value=0 placeholder="Price in USD" >
										<!--	<label>DELIVERY CHARGE</label>
											<input type="text" class="input-block-level"  name="charge"  placeholder="Delivery Charge" >-->
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
										</div>
						<!-- span 4 -->				
						<!-- span 4 -->	
						<div class="span6">
							
									
							<label>RECIEVER NAME:(المرسل اليه)</label>
							<input type="text" class="input-block-level"  name="rec_name" placeholder="Recipient Name" required>
							<label>RECIEVER ADDRESS:</label>
							<input type="text" class="input-block-level"  name="rec_address" placeholder="Recipient Address" required>
						
							<label>RECIEVER EMAIL:</label>
							<input type="email" class="input-block-level"  name="rec_email" placeholder="Email is Optional">
							<label>RECIEVER PHONE:</label>
							<input type="phone" class="input-block-level"  name="rec_tel" placeholder="Telephone No" onkeydown='return(event.which >= 48 && event.which <= 57)
											|| event.which ==8 || event.which == 46' maxlength ="13" required>
											<br>
							<button class="btn btn-success" name="save"><i class="icon-save icon-large"></i> Save </button>	
						</div>
						<!--end span 4 -->
						</form>						
			<script>
			jQuery(document).ready(function($){
				$("#add_order").submit(function(e){
					e.preventDefault();
					var _this = $(e.target);
					var formData = $(this).serialize();
					$.ajax({
						type: "POST",
						url: "save_order.php",
						data: formData,
						success: function(html){
							$.jGrowl("Order Successfully  Added", { header: 'Order Added' });
							window.location = 'orders.php';  
						},
				
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
		<?php //include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>	
</html>