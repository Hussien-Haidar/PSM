    <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
                    </a>
                    <a href="orders.php"><span class="brand" href="#">DELIVERY MANAGEMENT SYSTEM</span></a>
                    <div id="coll" class="nav-collapse collapse">
                        <ul class="nav pull-right">
						<?php 
					$query= mysqli_query($conn,"select * from users where user_id = '$session_id'")or die('Error, insert query failed');
						$row = mysqli_fetch_array($query);
						
						?>
                            <li class="dropdown">
                                <a href="#" id="name123" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user icon-large"></i><?php echo $row['name'];  ?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    
                                    <li><a  class="jkl" tabindex="-1" href="edit_profile.php"><i class="icon-user icon-large"></i>&nbsp;Edit Profile</a></li>
                                    <li class="divider"></li>
									<li>
                                        <a tabindex="-1" href="change_password.php" class="jkl"><i class="icon-lock icon-large"></i>&nbsp;Change Password</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a  class="jkl" tabindex="-1" href="logout.php"><i class="icon-signout icon-large"></i>&nbsp;Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
    </div>