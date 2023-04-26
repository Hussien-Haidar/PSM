<!-- delete modal -->
<div id="notification_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Permenantly Delete Notification?</h3>
    </div>
    <input type="hidden" value="<?php echo $get_id; ?>" class="input-block-level" name="id">
    <div class="modal-body">
        <div class="alert alert-danger">
            <p>Are you sure you want to delete this notification? it will gone forever from the systems.</p>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
        <button name="delete_notification" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
    </div>
</div>