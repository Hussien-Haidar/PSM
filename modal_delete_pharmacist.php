<!-- delete modal -->
<div id="pharmacist_delete_<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Permenantly Delete Account?</h3>
    </div>
    <form action="modal_action.php" method="post">

        <input type="hidden" value="<?php echo $row['id']; ?>" class="input-block-level" name="id">
        <input type="hidden" value="<?php echo $row['email']; ?>" class="input-block-level" name="email">
        <input type="hidden" value="<?php echo $row['username']; ?>" class="input-block-level" name="username">
        <input type="hidden" value="<?php echo $row['certificate']; ?>" class="input-block-level" name="certificate">

        <div class="modal-body">
            <div class="alert alert-danger">
                <p>Are you sure you want to delete the account? it will gone forever.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
            <button name="delete_pharmacist" class="btn btn-danger" value="1"><i class="icon-check icon-large"></i> Yes</button>
        </div>
    </form>
</div>















<!-- Rider user modal -->
<div id="user_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Archieve User ?</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger">
            <p>Are you sure you want to archieve the user?.</p>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
        <button name="delete_user" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
    </div>
</div>



<!-- Rider user modal -->
<div id="rider_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Archieve Rider ?</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger">
            <p>Are you sure you want to archieve the rider?.</p>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
        <button name="delete_rider" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
    </div>
</div>



<!-- Rider user modal -->
<div id="rider_activate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Activate Rider ?</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger">
            <p>Are you sure you want to activate the rider?.</p>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
        <button name="activate_rider" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
    </div>
</div>