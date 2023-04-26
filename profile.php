<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12" id="">
                    <div class="row-fluid">
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">
                                    <p><i class="icon-user icon-large"></i> Profile</p>
                                </div>

                                <div style="padding-left: 20px;" class="muted pull-left">
                                    <a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a>
                                </div>

                                <div class="muted pull-right">
                                    <a href="edit_profile.php"><i class="icon-pencil icon-large"></i> Edit</a>
                                </div>

                                
                            </div>
                            <div class="block-content collapse in">
                                <?php
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con, "SELECT * from pharmacists where id='$id'");
                                $row = mysqli_fetch_array($query);

                                ?>
                                <div class="alert alert-success">PROFILE DETAILS</div>
                                <div class="span5">
                                    Username: <strong><?php echo $row['username']; ?></strong>
                                    <hr>

                                    Pharmacy: <strong><?php echo $row['pharmacy_name']; ?></strong>
                                    <hr>

                                    Phone: <strong><?php echo '+961' . $row['phone_number']; ?></strong>
                                    <hr>

                                    Email: <strong><?php echo $row['email']; ?></strong>
                                    <hr>

                                    Loaction: <strong><?php echo $row['location']; ?></strong>
                                    <hr>

                                    Status: <strong><?php if ($row['status'] == 'verified') echo 'Active'; ?></strong>
                                </div>
                                <div class="span5">
                                    Full Name: <strong><?php echo $row['full_name']; ?></strong>
                                    <hr>

                                    Join Date: <strong><?php echo $row['created_at']; ?></strong>
                                    <hr>

                                    <a data-placement="left" title="Click to View Certificate" id="view<?php echo $id; ?>" href="view_certificate.php<?php echo '?id=' . $row['id']; ?>" class="btn btn-warning"><i class="icon-search icon-large"></i> View Certificate</a>
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