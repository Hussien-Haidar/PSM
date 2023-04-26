<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar_about.php'); ?>
                <div class="span4" id="">
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-info-sign icon-large"></i> About</div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div class="control-group">
                                        <div class="controls">
                                            <b>Welcome to PSM-(Pharmacist Management System)! Our system was designed with both pharmacists and patients in mind. Our goal
                                                is to provide a seamless and efficient way for pharmacists to input their inventory of medications, while also allowing
                                                patients to easily track the status of their medication using Google Maps.
                                            </b>
                                            <br>
                                            <br>
                                            <b>Our system makes it easy for pharmacists to keep their inventory up to date, reducing the likelihood of stockouts and
                                                ensuring that patients receive their medication on time. Patients can access our system through their mobile devices,
                                                allowing them to view the status of their medication in real-time and plan accordingly.
                                            </b>
                                            <br>
                                            <br>
                                            <b>
                                                We are committed to providing the highest quality service to both pharmacists and patients. If you have any questions
                                                or concerns about our system, please don't hesitate to contact us. Thank you for choosing our medication tracking
                                                system!
                                            </b>

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