<!-- edit modal -->
<div id="request_update" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Edit and Accept Request <?php echo $row['full_name']; ?>?</h3>
    </div>

    <input type="hidden" value="<?php echo $get_id; ?>" class="input-block-level" name="id">
    <input type="hidden" value="<?php echo $row['email']; ?>" class="input-block-level" name="email">
    <input type="hidden" value="<?php echo $row['certificate']; ?>" class="input-block-level" name="certificate">

    <div class="modal-body">
        <div class="alert alert-danger">
            <p>Are you sure you want to edit and accept this request?</p>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
        <button name="edit_and_accept_request" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
    </div>
</div>