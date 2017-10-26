<form role="form" class="form-inline" method="get" action="manageusers.php">
  <input type="number" class="hidden" name="uid" value="<?php echo $user['user_id']; ?>">
  <select name="role" class="form-control input-sm" required>
    <option value="">New Role</option>
    <?php
      foreach($roles as $role) {
        echo "<option value='". $role['role_id'] ."'>". $role['role_name']."</option>";
      }
    ?>
  </select>
  <button type="submit" class="btn btn-success btn-sm"  onclick="if (! confirm('Are you sure to change the role of this user?')) { return false; }"><span class="glyphicon glyphicon-ok"></span> Apply</button>
</form>
