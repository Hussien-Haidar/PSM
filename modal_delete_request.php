<!-- delete modal -->
<div id="request_delete_<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Permanently Delete Request <?php echo $row['full_name']; ?>?</h3>
    </div>
    <form method="POST" action="modal_action.php">

        <input type="hidden" value="<?php echo $id; ?>" class="input-block-level" name="id">
        <input type="hidden" value="<?php echo $row['certificate']; ?>" class="input-block-level" name="certificate">
        
        <div class="modal-body">
            <div class="alert alert-danger">
                <p>Are you sure you want to delete this request? It will be gone forever.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
            <button type="submit" name="delete_request" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
        </div>
    </form>
</div>