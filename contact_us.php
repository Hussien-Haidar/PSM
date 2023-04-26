<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <body>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar_contact_us.php'); ?>
                <div class="span3" id="">
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-envelope icon-large"></i> Contact Us</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div class="control-group">
                                        <div class="controls">
                                            <p><i class="icon-phone icon-large"></i> 0096181041496</p>
                                            <a href="mailto: 72030603@students.liu.edu.lb"><i class="icon-envelope icon-large"></i> 72030603@students.liu.edu.lb</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span3" id="">
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-facebook icon-large"></i> Follow Us</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div class="control-group">
                                        <div class="controls">
                                            <a style="margin-right: 10px;" href="#facebook" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
                                            <a style="color: pink; margin-right: 10px;" href="#instagram" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
                                            <a style="margin-right: 10px;" href="#twitter" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
                                            <a style="color: red; margin-right: 10px;" href="#youtube" target="_blank"><i class="fab fa-youtube fa-2x"></i></a>
                                            <a href="#telegram" target="_blank"><i class="fab fa-telegram fa-2x"></i></a>
                                        </div>
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