<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><i class="icon-cog icon-large"></i> Configure Notification</div>
        </div>

        <div class="block-content collapse in">
            <div class="span12">
                <label>DESTINATION</label>
                <dd><label class="radio-inline"><input type="radio" name="destination" value="user" required> user</label></dd>
                <dd><label class="radio-inline"><input type="radio" name="destination" value="pharmacist" required> pharmacist</label></dd>
                <dd><label class="radio-inline"><input type="radio" name="destination" value="both" required> both</label></dd>

                <br>

                <label>IMPORTANCE</label>
                <select name="importance">
                    <option value="normal">Normal</option>
                    <option value="important">Important</option>
                </select>
            </div>
        </div>
    </div>
</div>