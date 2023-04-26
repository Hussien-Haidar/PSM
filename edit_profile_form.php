<div class="row-fluid">
    <a href="javascript:history.go(-1)" class="btn btn-info"><i class="icon-arrow-left icon-large"></i> Back</a>
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Profile</div>
        </div>
        <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "select * from pharmacists where id = '$id'");
        $row = mysqli_fetch_array($query);
        ?>
        <div class="block-content collapse in">
            <div class="span12">
                <form method="post" id='profile_update'>
                    <div class="control-group">
                        <div class="controls">
                            <label>USERNAME</label>
                            <input name="id" value="<?php echo $row['id']; ?>" type="hidden">
                            <input name="username" value="<?php echo $row['username']; ?>" class="input focused" id="focusedInput" type="text" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <label>PHONE NUMBER</label>
                            <input name="phone_number" value="<?php echo $row['phone_number'] ?>" class="input focused" id="focusedInput" type="tel" pattern="^(?:\+961|961|0)?(1(?:0[0-2]|[2-9]\d)|3[0-9]|7(?:0|1|8)|81)\d{6}$" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button name="update" class="btn btn-success"><i class="icon-save icon-large"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $exist = false;

    $check_info = mysqli_query($con, "SELECT * FROM pharmacists WHERE id = '$id' AND username = '$username'");

    if (mysqli_num_rows($check_info) > 0)
        $exist = true;

    $result = mysqli_query($con, "UPDATE pharmacists
    SET username='$username', phone_number='$phone_number'
    WHERE id = '$id' AND NOT EXISTS ( SELECT * FROM pharmacists
    WHERE (username = '$username' OR phone_number = '$phone_number') AND id <> '$id')");

    if (mysqli_affected_rows($con)) { ?>
        <script>
            $.jGrowl("Profile Successfully Updated", {
                header: 'Profile Updated'
            });
            var delay = 2000;
            setTimeout(function() {
                window.location = 'profile.php'
            }, delay);
        </script>
    <?php $_SESSION['username'] = $username;
    } else if ($exist) { ?>
        <script>
            $.jGrowl("No data changed to edit profile", {
                header: 'Failed to Edit Profile'
            });
            var delay = 4000;
        </script>

    <?php } else { ?>

        <script>
            $.jGrowl("username is already exists", {
                header: 'Failed to Edit profile'
            });
            var delay = 4000;
        </script>

<?php
    }
} ?>