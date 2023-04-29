<!-- accept modal -->
<div id="request_accept_<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Accept Request <?php echo $row['full_name']; ?>?</h3>
    </div>
    <form method="POST" action="modal_action.php">

        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
        <input type="hidden" value="<?php echo $row['full_name']; ?>" name="full_name">
        <input type="hidden" value="<?php echo $row['pharmacy_name']; ?>" name="pharmacy_name">
        <input type="hidden" value="<?php echo $row['email']; ?>" name="email">
        <input type="hidden" value="<?php echo $row['phone_number']; ?>" name="phone_number">
        <input type="hidden" value="<?php echo $row['certificate']; ?>" name="certificate">
        <input type="hidden" value="<?php echo $row['location']; ?>" name="location">

        <div class="modal-body">
            <div class="alert alert-danger">
                <p>Are you sure you want to Accept this request? The pharmacist will be notified
                    and can start using the system.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
            <button type="submit" name="accept_request" class="btn btn-success" value="1"><i class="icon-check icon-large"></i> Yes</button>
        </div>
    </form>
</div>