<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>

<body>
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
                                $query_admins = mysqli_query($con, "select * from admins");
                                $query_pharmacists = mysqli_query($con, "select * from pharmacists");
                                $query_enabled_pharmacists = mysqli_query($con, "select * from pharmacists WHERE status='verified'");
                                $query_disabled_pharmacists = mysqli_query($con, "select * from pharmacists WHERE status='disabled'");
                                $query_users = mysqli_query($con, "select * from users");
                                $query_requests = mysqli_query($con, "select * from requests");
                                $query_medicines = mysqli_query($con, "select * from medicines");
                                $query_saved_medicines = mysqli_query($con, "select * from saved_medicines");
                                $query_wanted_medicines = mysqli_query($con, "select * from wanted_medicines");

                                $count_admins = mysqli_num_rows($query_admins);
                                $count_pharmacists = mysqli_num_rows($query_pharmacists);
                                $count_enabled_pharmacists = mysqli_num_rows($query_enabled_pharmacists);
                                $count_disabled_pharmacists = mysqli_num_rows($query_disabled_pharmacists);
                                $count_users = mysqli_num_rows($query_users);
                                $count_requests = mysqli_num_rows($query_requests);
                                $count_medicines = mysqli_num_rows($query_medicines);
                                $count_saved_medicines = mysqli_num_rows($query_saved_medicines);
                                $count_wanted_medicines = mysqli_num_rows($query_wanted_medicines);
                                ?>
                                
                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_admins; ?>"><?php echo $count_admins; ?></div>
                                    <div class="chart-bottom-heading"><strong>ADMINS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_pharmacists; ?>"><?php echo $count_pharmacists; ?></div>
                                    <div class="chart-bottom-heading"><strong>PHARMACISTS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_enabled_pharmacists; ?>"><?php echo $count_enabled_pharmacists; ?></div>
                                    <div class="chart-bottom-heading"><strong>ENABLED PHARMACISTS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_disabled_pharmacists; ?>"><?php echo $count_disabled_pharmacists; ?></div>
                                    <div class="chart-bottom-heading"><strong>DISABLED PHARMACISTS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_users; ?>"><?php echo $count_users; ?></div>
                                    <div class="chart-bottom-heading"><strong>USERS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_medicines; ?>"><?php echo $count_medicines; ?></div>
                                    <div class="chart-bottom-heading"><strong>MEDICINES</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_requests; ?>"><?php echo $count_requests; ?></div>
                                    <div class="chart-bottom-heading"><strong>REQUESTS</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_saved_medicines; ?>"><?php echo $count_saved_medicines; ?></div>
                                    <div class="chart-bottom-heading"><strong>SAVED MEDICINES</strong>
                                    </div>
                                </div>

                                <div class="span3">
                                    <div class="chart" data-percent="<?php echo $count_wanted_medicines; ?>"><?php echo $count_wanted_medicines; ?></div>
                                    <div class="chart-bottom-heading"><strong>WANTED MEDICINES</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include('script.php'); ?>
</body>

<?php } ?>

</html>