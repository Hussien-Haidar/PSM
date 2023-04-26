			<div class="span3" id="sidebar">
	<center>
		<img src="./../images/logo.png" width="80px" height="100px" id="logo">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
					   
					<li <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="../orders.php"><i class="icon-chevron-left icon-large"></i><i class="icon-back icon-large"></i> Back</a></li>
						<li <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="dashboard.php"><i class="icon-chevron-right icon-large"></i><i class="icon-dashboard icon-large"></i> Dashboard</a></li>
						<li class="active" <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="expenses.php"><i class="icon-chevron-right icon-large"></i><i class="icon-shopping-cart icon-large"></i> Expenses</a></li>
					    <li <?php if($campus=="dataEntry")echo "style='display:none'";?>  ><a href="incomes.php"><i class="icon-chevron-right icon-large"></i><i class="icon-money icon-large"></i> Incomes</a></li>
						<li <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="categories.php"><i class="icon-chevron-right icon-large"></i><i class="icon-columns icon-large"></i> Categories</a></li> 
						<li <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="salaries.php"><i class="icon-chevron-right icon-large"></i><i class="icon-group icon-large"></i> Salaries</a></li> 
                        <li <?php if($campus=="dataEntry")echo "style='display:none'";?> ><a href="reports.php"><i class="icon-chevron-right icon-large"></i><i class="icon-bar-chart icon-large"></i> Reports</a></li> 
                    </ul>
	</center>
            </div>