<?php include('header.php'); ?>
<?php include('navbar_index.php'); ?>

<body id="login">
    <div style="padding-top: 50px;" class="container">
        <form id="forget_password" class="form-signin" method="post">
            <h3 class="form-signin-heading"><i class="icon-envelope"></i> Enter your Email Address</h3>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="email" id="confirm_email" name="confirm_email" placeholder="Confirm Email" required>
            <br>
            <a href="javascript:history.go(-1)" title="Click to Return" class="btn btn-inverse">Back</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" data-placement="right" id="save" name="save" class="btn btn-success"><i class="icon-envelope icon-large"></i> Send</button>


            <script>
                jQuery(document).ready(function() {
                    jQuery("#forget_password").submit(function(e) {
                        e.preventDefault();
                        var email = jQuery('#email').val();
                        var confirm_email = jQuery('#confirm_email').val();
                        if (email != confirm_email) {
                            $.jGrowl("Emails does not match each others", {
                                header: 'Failed to Send'
                            });
                        } else if ((email == confirm_email)) {
                            var formData = jQuery(this).serialize();
                            $.ajax({
                                type: "POST",
                                url: "forgot_password_action.php",
                                data: formData,
                                success: function(html) {
                                    if (html == 'no_email_found') {
                                        $.jGrowl("No email found on the system", {
                                            header: 'Failed to Send'
                                        });
                                        var delay = 5000;
                                    } else if (html == 'email_found') {
                                        $.jGrowl("verification email has been sent successfully", {
                                            header: 'Verification Email Sent'
                                        });
                                        var delay = 4000;
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
        </form>
    </div>

</body>

</html>