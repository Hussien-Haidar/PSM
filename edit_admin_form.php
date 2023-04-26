<div class="row-fluid">
  <a href="javascript:history.go(-1)" class="btn btn-info"><i class="icon-arrow-left icon-large"></i> Back</a>
  <!-- block -->
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Edit Administrator</div>
    </div>
    <?php
    $query = mysqli_query($con, "select * from admins where id = '$get_id'");
    $row = mysqli_fetch_array($query);
    ?>
    <div class="block-content collapse in">
      <div class="span12">
        <form method="post" id='admin_update'>
          <?php
          if ($row['username'] == $_SESSION['username']) { ?>
            <input name="active_admin" value="active admin" type="hidden">
          <?php } ?>

          <div class="control-group">
            <div class="controls">
              <label>USERNAME</label>
              <input name="username" value="<?php echo $row['username']; ?>" class="input focused" id="focusedInput" type="text" required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <label>FULL NAME</label>
              <input name="full_name" value="<?php echo $row['full_name'] ?>" class="input focused" id="focusedInput" type="text" required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <label>EMAIL</label>
              <input name="email" value="<?php echo $row['email']; ?>" class="input focused" id="focusedInput" type="text" required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <label>PASSWORD</label>
              <input name="password" value="<?php echo $row['password']; ?>" class="input focused" id="focusedInput" type="text" required>
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
  $id = $_GET['id'];
  $username = $_POST['username'];
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $exist = false;

  $check_info = mysqli_query($con, "SELECT * FROM admins WHERE id = '$id' AND username = '$username'
  AND full_name='$full_name' AND email = '$email' AND password = '$password'");

  if (mysqli_num_rows($check_info) > 0)
    $exist = true;

  $result = mysqli_query($con, "UPDATE admins
  SET username='$username', full_name='$full_name', email='$email', password='$password'
    WHERE id = '$id' AND NOT EXISTS ( SELECT * FROM admins
    WHERE (username = '$username' OR email = '$email') AND id <> '$id')");

  if (mysqli_affected_rows($con)) { ?>
    <script>
      $.jGrowl("Admin Successfully Updated", {
        header: 'Administrator Updated'
      });
      var delay = 2000;
      setTimeout(function() {
        window.location = 'users.php'
      }, delay);
    </script>
    <?php
    if (isset($_POST['active_admin'])) {
      $_SESSION['username'] = $username;
    }
  } else if ($exist) { ?>
    <script>
      $.jGrowl("No data changed to edit admin", {
        header: 'Failed to Edit Admin'
      });
      var delay = 4000;
    </script>

  <?php } else { ?>

    <script>
      $.jGrowl("username or email is already exists", {
        header: 'Failed to Edit Admin'
      });
      var delay = 4000;
    </script>

<?php
  }
}
?>