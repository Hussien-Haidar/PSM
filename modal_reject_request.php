<!-- reject modal -->
<div id="request_reject_<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Reject Request <?php echo $row['full_name']; ?>?</h3>
    </div>
    <form method="POST" action="modal_action.php">

        <input type="hidden" value="<?php echo $id; ?>" class="input-block-level" name="id">
        <input type="hidden" value="<?php echo $email; ?>" class="input-block-level" name="email">
        <input type="hidden" value="<?php echo $full_name; ?>" class="input-block-level" name="full_name">

        <div class="modal-body">
            <div class="alert alert-danger">
                <p>Are you sure you want to reject this request? The pharmacist will be notified also.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
            <button type="submit" name="reject_request" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
        </div>
    </form>
</div>