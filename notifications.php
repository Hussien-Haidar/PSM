<?php include('session.php'); ?>
<?php if($_SESSION['role']=='pharmacist') echo 'access denied'; else { ?>
<?php include('header.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar_notifications.php'); ?>
            <form id="send_notification" class="form-signin" method="post">
                <div class="span3" id="">


                    <?php if(!isset($_GET["status"]) || $_GET["status"] != "sent") 
                    include('config_notification.php');
                    ?>
                
                
                </div>
                <div class="span6" id="">
                    <div class="row-fluid">
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <?php
                                $query = mysqli_query($con, "select * from users");
                                $count = mysqli_num_rows($query);
                                ?>
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Compose Notification</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">

                                    <div style="overflow-x:auto;">

                                        <div>
                                            <a href="?status" <?php if (!isset($_GET["status"]) || $_GET["status"] == "") echo "class='btn btn-success'";
                                                                else echo "class='btn'";  ?>> Compose</a>

                                            <a href="?status=sent" <?php if (!isset($_GET["status"]) || $_GET["status"] != "sent") echo "class='btn'";
                                                                    else if (isset($_GET["status"]) && $_GET["status"] == "sent") echo "class='btn btn-success'"; ?>> Sent</a>
                                        </div>

                                        <br>

                                        <table cellpadding="0" cellspacing="0" borders="0" class="table" id="example">
                                            <?php
                                            if (isset($_GET["status"]) && $_GET["status"] == "sent") {
                                                $query = mysqli_query($con, "select * from notifications");
                                            ?>
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Destination</th>
                                                        <th>Importance</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        $id = $row['id'];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['destination']; ?> </td>
                                                            <?php
                                                            if ($row['importance'] == 'normal') { ?>
                                                                <td><?php echo $row['importance']; ?> </td>
                                                            <?php } else { ?>
                                                                <td style="color: red; font-weight: bold;"><?php echo $row['importance']; ?> </td>
                                                            <?php } ?>
                                                            <td><?php echo $row['created_at']; ?></td>
                                                            <td class="empty">
                                                                <a data-placement="left" title="Click to View" id="view<?php echo $id; ?>" href="view_notification.php<?php echo '?id=' . $id; ?>" class="btn btn-success"><i class="icon-search icon-large"></i> View</a>
                                                                <script type="text/javascript">
                                                                    $(document).ready(function() {
                                                                        $('#edit<?php echo $id; ?>').tooltip('show');
                                                                        $('#edit<?php echo $id; ?>').tooltip('hide');
                                                                    });
                                                                </script>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="span6">
                                                    <label>TITLE</label>
                                                    <input type="text" class="input-block-level" name="title" required>
                                                </div>

                                                <div class="span11">
                                                    <label>BODY</label>
                                                    <textarea class="input-block-level" name="body" rows="12" required></textarea>
                                                    <br>
                                                    <button class="btn btn-success" name="send"><i class="icon-chevron-right icon-large"></i> Send</button>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                jQuery(document).ready(function($) {
                    $("#send_notification").submit(function(e) {
                        e.preventDefault();
                        var _this = $(e.target);
                        var formData = $(this).serialize();
                        $.ajax({
                            type: "POST",
                            url: "send_notification.php",
                            data: formData,
                            success: function(html) {
                                $.jGrowl("Notification is directed to destination", {
                                    header: 'Notification sent'
                                });
                                var delay = 2000;
                                setTimeout(function() {
                                    window.location = 'notifications.php'
                                }, delay);
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
    <?php include('script.php'); ?>
</body>

<?php } ?>

</html>