<div class="row-fluid">
    <a href="javascript:history.go(-1)" class="btn btn-info"><i class="icon-arrow-left icon-large"></i> Back</a>
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Medicine</div>
        </div>
        <?php
        $id_pharmacist = $_SESSION['id'];
        $query = mysqli_query($con, "select * from medicines where id = '$get_id' and id_pharmacist='$id_pharmacist'");
        $row = mysqli_fetch_array($query);
        ?>
        <div class="block-content collapse in">
            <div class="span12">
                <form method="post" id='medicine_update'>
                    <div class="control-group">
                        <div class="controls">
                            <label>NAME</label>
                            <input name="id" value="<?php echo $_SESSION['id']; ?>" type="hidden">
                            <input name="name" value="<?php echo $row['name']; ?>" class="input focused" id="focusedInput" type="text" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <label>QUANTITY</label>
                            <input name="amount" value="<?php echo $row['amount'] ?>" class="input focused" id="focusedInput" type="number" min="0" required>
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
    $id = $get_id;
    $id_pharmacist = $_POST['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $exist = false;

    $check_info = mysqli_query($con, "SELECT * FROM medicines WHERE id = '$id' and id_pharmacist = '$id_pharmacist' AND name = '$name'");

    if (mysqli_num_rows($check_info) > 0)
        $exist = true;

    $result = mysqli_query($con, "UPDATE medicines
    SET name='$name', amount='$amount'
    WHERE id = '$id' and id_pharmacist = '$id_pharmacist' AND NOT EXISTS ( SELECT * FROM medicines
    WHERE (name = '$name' and id_pharmacist='$id_pharmacist') AND id <> '$id')");

    if (mysqli_affected_rows($con)) { ?>
        <script>
            $.jGrowl("Medicine Successfully Updated", {
                header: 'Medicine Updated'
            });
            var delay = 2000;
            setTimeout(function() {
                window.location = 'my_medicines.php'
            }, delay);
        </script>
    <?php
    } else if ($exist) { ?>
        <script>
            $.jGrowl("No data changed to edit medicine", {
                header: 'Failed to Edit Medicine'
            });
            var delay = 4000;
        </script>

    <?php } else { ?>

        <script>
            $.jGrowl("Medicine is already exists", {
                header: 'Failed to Edit Medicine'
            });
            var delay = 4000;
        </script>

<?php
    }
} include('script.php') ?>