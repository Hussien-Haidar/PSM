<!-- enable account modal -->
<div id="pharmacist_enable_<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Enable Account?</h3>
    </div>
    <form action="modal_action.php" method="post">
        <input type="hidden" value="<?php echo $row['id']; ?>" class="input-block-level" name="id">
        <input type="hidden" value="<?php echo $row['email']; ?>" class="input-block-level" name="email">
        <input type="hidden" value="<?php echo $row['username']; ?>" class="input-block-level" name="username">

        <div class="modal-body">
            <div class="alert alert-danger">
                <p>Are you sure you want to enable the account? the pharmacist will be notified
                    and can use the system again.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
            <button name="enable_pharmacist" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
        </div>
    </form>
</div>
