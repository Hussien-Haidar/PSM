<?php if (!isset($_GET['email']) || $_GET['email'] == null) echo 'access denied';
else {
    include('header.php');
    $email = $_GET['email'];
?>

    <body id="login">
        <div class="container">
            <form id="reset_password" class="form-signin" method="post">
                <h3 class="form-signin-heading"><i class="icon-lock"></i> Reset Password</h3>
                <input type="hidden" name="email" value="<?php echo $email; ?>" required>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                <input type="password" id="retype_password" name="retype_password" placeholder="Re-type Password" required>
                <br>
                <button type="submit" data-placement="right" id="save" name="save" class="btn btn-success"><i class="icon-save icon-large"></i> Save</button>

                <script>
                    jQuery(document).ready(function() {
                        jQuery("#reset_password").submit(function(e) {
                            e.preventDefault();
                            var new_password = jQuery('#new_password').val();
                            var retype_password = jQuery('#retype_password').val();
                            if (new_password != retype_password) {
                                $.jGrowl("Password does not match with your new password", {
                                    header: 'Reset Password Failed'
                                });
                            } else if (new_password == retype_password) {
                                var formData = jQuery(this).serialize();
                                $.ajax({
                                    type: "POST",
                                    url: "reset_password.php",
                                    data: formData,
                                    success: function(html) {
                                        $.jGrowl("Your password has been reset successfully", {
                                            header: 'Reset Password Success'
                                        });
                                        var delay = 3000;
                                        setTimeout(function() {
                                            window.location = 'home.php'
                                        }, delay);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </form>

            <?php
            if (isset($_POST["new_password"])) {
                $email = $_POST['email'];
                $new_password  = $_POST['new_password'];
                mysqli_query($con, "UPDATE pharmacists SET password = '$new_password' where email = '$email'");
            }
            ?>

        </div>

    </body>

    </html>

<?php }
