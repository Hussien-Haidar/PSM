<?php

use Svg\Style;

include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <style>
        .message-href {
            color: black;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar_my_notifications.php'); ?>
                <div class="span5" id="">
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-bell icon-large"></i> My Notifications</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div style="overflow: hidden;" class="control-group">
                                        <?php $result = mysqli_query($con, "SELECT * FROM notifications where destination='pharmacist' OR destination='both'");
                                        while ($row = mysqli_fetch_array($result)) { ?>
                                            <a href="view_my_notification.php?id=<?php echo $row['id']; ?>" class="message-href">
                                                <h4 <?php if ($row['importance'] == 'important') echo "style='color: red'"; ?>>
                                                    <?php if ($row['importance'] == 'important') echo $row['title'] . ' (Important)';
                                                    else echo $row['title'] ?>
                                                </h4>
                                                <div><b><?php echo $row['body']; ?></b></div>
                                                <hr>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php

    include('script.php');
} ?>

</html>