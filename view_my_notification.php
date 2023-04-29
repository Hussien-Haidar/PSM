<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <?php $get_id = $_GET['id']; ?>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar_my_notifications.php'); ?>
                <div class="span9" id="">
                    <div class="row-fluid">
                        <form action="modal_action.php" method="post">
                            <div id="block_bg" class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">
                                        <a href="javascript:history.go(-1)"><i class="icon-arrow-left icon-large"></i> Back</a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <?php
                                    $query = mysqli_query($con, "select * from notifications where id='$get_id'");
                                    $row = mysqli_fetch_array($query);
                                    ?>
                                    <div class="alert alert-success">NOTIFICATION DETAILS</div>
                                    <div class="span9">
                                        Importance: <?php if ($row['importance'] == 'normal') { ?>
                                            <strong>normal</strong>
                                        <?php } else { ?>
                                            <strong style="color: red;">Important</strong>
                                        <?php } ?>
                                        <hr>

                                        Title: <strong><?php echo $row['title']; ?></strong>
                                        <hr>

                                        Body: <strong><?php echo $row['body']; ?></strong>
                                        <hr>

                                        Date Sent: <strong><?php echo $row['created_at']; ?></strong>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <?php include('modal_delete_notification.php'); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script.php'); ?>
    </body>

<?php } ?>

</html>