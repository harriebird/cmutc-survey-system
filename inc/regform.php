<div class="panel panel-success animated lightSpeedIn">
  <div class="panel-heading">
    <h3 class="panel-title">Don't have an account? Register here</h3>
  </div>
  <div class="panel-body">
    <form role="form" class="form-default" method="post" action="register.php">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname'];?>" placeholder="Enter Last Name" required>
          </div>
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>" placeholder="Enter First Name" required>
          </div>
          <div class="form-group">
            <label for="mname">Middle Name</label>
            <input type="text" class="form-control" id="mname" name="mname" value="<?php if(isset($_POST['mname'])) echo $_POST['mname'];?>" placeholder="Enter Middle Name" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
              <option value="">Select a Gender</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="prog">Academic Program</label>
            <select name="prog" class="form-control"  required>
              <option value="">Select a Program here</option>
              <?php
                require 'inc/connection.php';
                $query = "SELECT program_id,program_name FROM programs ORDER BY program_name";
                $result = mysqli_query($connection,$query);
                foreach($result as $prog) {
                  echo "<option value='". $prog['program_id'] ."'>". $prog['program_name']."</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder="user@domain.com" required>
          </div>
          <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="bday">Birthday (YYYY-MM-DD)</label>
            <input type="date" class="form-control" id="bday" name="bday" value="<?php if(isset($_POST['bday'])) echo $_POST['bday'];?>" placeholder="YYYY-MM-DD" required>
          </div>
          <div class="form-group">
            <button type="submit" name="regButton" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-ok"></span> Register</button>
            <button type="reset" class="btn btn-warning btn-block">Reset</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
