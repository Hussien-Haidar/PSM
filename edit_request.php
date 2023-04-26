<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar_requests.php'); ?>
            <div class="span9" id="">
                <div class="row-fluid">
                    <!-- block -->
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Request</div>
                            <div class="muted pull-right"><a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a></div>
                        </div>
                        <div class="block-content collapse in">
                            <?php
                            $query = mysqli_query($con, "select * from requests where id = '$get_id'");
                            $row = mysqli_fetch_array($query);

                            ?>
                            <form action="modal_action.php" id="update_request" class="form-signin" method="post">
                                <div class="span4">
                                    <input type="hidden" class="input-block-level" name="id" value="<?php echo $row['id']; ?>" required>

                                    <label>FULL NAME:</label>
                                    <input type="text" class="input-block-level" name="full_name" value="<?php echo $row['full_name']; ?>" required>

                                    <label>PHARMACY NAME:</label>
                                    <input type="text" class="input-block-level" name="pharmacy_name" value="<?php echo $row['pharmacy_name']; ?>" required>

                                    <label>Email</label>
                                    <input type="text" class="input-block-level" name="email" value="<?php echo $row['email']; ?>" disabled>

                                    <label>PHONE NUMBER</label>
                                    <input type="tel" pattern="^(?:\+961|961|0)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81)\d{6}$" class="input-block-level" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
                                </div>

                                <div class="span8">
                                    <label>LOCATION</label>
                                    <input type="text" class="input-block-level" name="location" value="<?php echo $row['location']; ?>" required>

                                    <div class="control-group">
                                        <div class="controls">
                                            <a data-toggle="modal" title="Update Request" href="#request_update" id="update_request<?php echo $id; ?>" class="btn btn-success">
                                                <i class="icon-save icon-large"></i> Edit and Accept
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php include('modal_edit_request.php'); ?>
                            </form>
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