<?php include('session.php'); ?>
<?php if ($_SESSION['role'] == 'admin') echo 'access denied';
else { ?>
    <?php include('header.php'); ?>

    <body>
        <?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include('sidebar_my_medicines.php'); ?>
                <div class="span3" id="">
                    <?php include('add_medicine.php');  ?>
                </div>
                <div class="span6" id="">
                    <div class="row-fluid">
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <?php
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con, "select * from medicines where id_pharmacist='$id'");
                                $count = mysqli_num_rows($query);
                                ?>
                                <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Medicines List</div>
                                <div class="muted pull-right">
                                    Number of Medicines: <span id="count" class="badge badge-info"><?php echo $count; ?></span>
                                </div>
                            </div>

                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div style="overflow-x:auto;">
                                        <table cellpadding="0" cellspacing="0" borders="0" class="table" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Date Created</th>
                                                    <th class="empty">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query)) {  ?>
                                                    <tr>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['amount']; ?> </td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td>
                                                            <a data-placement="left" title="Click to Edit" id="edit<?php echo $row['id']; ?>" href="edit_medicine.php<?php echo '?id=' . $row['id']; ?>" class="btn btn-success"><i class="icon-pencil icon-large"></i> Edit</a>
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $('#edit<?php echo $row['id']; ?>').tooltip('show');
                                                                    $('#edit<?php echo $row['id']; ?>').tooltip('hide');
                                                                });
                                                            </script>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script.php'); ?>
    </body>

<?php } ?>

</html>