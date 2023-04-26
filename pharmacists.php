<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar_pharmacists.php'); ?>
            <div class="span9" id="">
                <div class="row-fluid">
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <?php
                        $count = 0;

                        ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Accounts List</div>
                            <div class="muted pull-right">
                                Number of Accounts: <span id="count" class="badge badge-info"><?php echo $count;  ?></span>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12" id="studentTableDiv">
                                <h2 id="noch">Accounts List</h2>
                                <?php include('pharmacists_table.php'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
    <?php include('script.php'); ?>
</body>

<?php } ?>

</html>