<?php include('session.php'); ?>
<?php include('header.php'); ?>
    <body >
		<?php include('navbar.php') ?>
        <div class="container-fluid" id="">
            <div class="row-fluid">
					<?php include('sidebar_dashboard.php'); ?>
                <!--/span-->
                <div class="span9" id="content">
						<div class="row-fluid"></div>
						
                    <div class="row-fluid">
            
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">STATISTICS</div>
                            </div>
                            <div class="block-content collapse in">
							        <div class="span12">
						
									<?php 
								$query_students = mysqli_query($conn,"select * from orders where sender_id= $user_id ");
								$count_students = mysqli_num_rows($query_students);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_students; ?>"><?php echo $count_students; ?></div>
                                    <div class="chart-bottom-heading"><strong>ORDERS</strong>

                                    </div>
                                </div>
								
								<?php 
								$query_class = mysqli_query($conn,"select * from users");
								$count_class = mysqli_num_rows($query_class);
								?>
								
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_class; ?>"><?php echo $count_class; ?></div>
                                    <div class="chart-bottom-heading"><strong>USERS</strong>

                                    </div>
                                </div>
								<?php 
																
								$query_nursery = mysqli_query($conn," select * from riders");
								
								$count_nursery = mysqli_num_rows($query_nursery);
								
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_nursery; ?>"><?php echo $count_nursery; ?></div>
                                    <div class="chart-bottom-heading"><strong>RIDERS</strong>

                                    </div>
                                </div>
								
								<?php 
								$query_primary = mysqli_query($conn," select * from orders where status ='Exempted' AND sender_id= $user_id");
								$count_primary = mysqli_num_rows($query_primary);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_primary; ?>"><?php echo $count_primary; ?></div>
                                    <div class="chart-bottom-heading"><strong>PAYED ORDERS</strong>

                                    </div>
                                </div>
								
								
										<?php 
								$query_secondary = mysqli_query($conn," select * from riders where status ='Online'");
								$count_secondary = 0;// mysqli_num_rows($query_secondary);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_secondary ?>"><?php echo $count_secondary ?></div>
                                    <div class="chart-bottom-heading"><strong>ONLINE DRIVERS</strong>

                                    </div>
                                </div>
								
								
										<?php 
								$query_admin = mysqli_query($conn," select * from users where status='administrator' ");
								$count_admin = 0;// mysqli_num_rows($query_admin);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_admin ?>"><?php echo $count_admin ?></div>
                                    <div class="chart-bottom-heading"><strong>ADMIN USERS</strong>

                                    </div>
                                </div>
								
										<?php 
								$query_normal = mysqli_query($conn," select * from users where status='normal'");
								$count_normal = 0;//mysqli_num_rows($query_normal);
								?>
								
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_normal; ?>"><?php echo $count_normal; ?></div>
                                    <div class="chart-bottom-heading"><strong>NORMAL USERS</strong>

                                    </div>
                                </div>
								
                            </div>
                        </div>
                        <!-- /block -->
						
                    </div>
                    </div>
                
                </div>
            </div>
    
         <?php include('footer.php'); ?>
		 
        </div>
	<?php include('script.php'); ?>
    </body>
</html>