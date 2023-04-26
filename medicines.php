<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar_medicines.php'); ?>
            <div class="span9" id="">
                <div class="row-fluid">
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <?php
                        $query = mysqli_query($con, "select * from medicines");
                        $count = mysqli_num_rows($query);

                        ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Medicines List</div>
                            <div class="muted pull-right">
                                Number of Medicines: <span id="count" class="badge badge-info"><?php echo $count;  ?></span>
                            </div>
                        </div>

                        <div class="block-content collapse in">
                            <div class="span12" id="studentTableDiv">
                                <?php include('medicines_table.php'); ?>
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