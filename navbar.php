    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a><span class="brand">PHARMACIST SYSTEM MANAGEMENT</span></a>
                <div id="coll" class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" id="name123" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user icon-large"></i><?php echo $_SESSION['username'];  ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'pharmacist') { ?>
                                    <li>
                                        <a tabindex="-1" href="profile.php" class="jkl"><i class="icon-user icon-large"></i>&nbsp;Profile</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a tabindex="-1" href="change_password.php" class="jkl"><i class="icon-lock icon-large"></i>&nbsp;Change Password</a>
                                    </li>

                                    <li class="divider"></li>
                                <?php } ?>

                                <li><a class="jkl" tabindex="-1" href="logout.php"><i class="icon-signout icon-large"></i>&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>