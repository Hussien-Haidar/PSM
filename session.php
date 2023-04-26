<?php
include('dbcon.php');
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) { ?>
    <script>
        window.location = "home.php";
    </script>
<?php
}
?>