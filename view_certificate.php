<?php include('session.php'); ?>
<?php include('header.php'); ?>
<?php $get_id = $_GET['id']; ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12" id="">
                <div class="row-fluid">
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">
                                <a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a>
                            </div>
                        </div>

                        <?php
                        $query = mysqli_query($con, "select * from requests where id='$get_id'");
                        if (mysqli_num_rows($query) == 0) {
                            $query = mysqli_query($con, "select * from pharmacists where id='$get_id'");
                            $row = mysqli_fetch_array($query);
                        } else
                            $row = mysqli_fetch_array($query);

                        ?>

                        <div class="block-content collapse in">
                            <div class="alert alert-success">CERTIFICATE OF: <?php echo $row['full_name']; ?></div>
                            <?php if ($row['certificate'] == '') echo 'no image found';
                            else { ?>
                                <img style="border: 3px solid grey;" src="img/<?php echo $row['certificate']; ?>" />
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>