<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>
<?php include('header_map.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar_requests.php'); ?>
            <div class="span9" id="">
                <div class="row-fluid">
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <?php
                        $query = mysqli_query($con, "select * from requests");
                        if ($query) {
                            $count = mysqli_num_rows($query);
                        } else $count = 0;
                        ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Requests List</div>
                            <div class="muted pull-right">
                                Number of Requests: <span id="count" class="badge badge-info"><?php echo $count;  ?></span>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12" id="riderTableDiv">
                                <h2 id="noch">Requests List</h2>
                                <?php include('requests_table.php'); ?>
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
