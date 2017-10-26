<div class="panel panel-primary animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Add an Offered Subject</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="manageoffers.php">
      <h5>This will enable a tutor to offer a subject to teach.</h5>
      <div class="form-group">
        <label for="subcode">Subject</label>
        <select name="subject"class="form-control" required>
          <option value="">Select a Subject here</option>
          <?php
            require 'inc/connection.php';
            $query = "SELECT * FROM subjects ORDER BY subject_code";
            $subs = mysqli_query($connection,$query);
            foreach($subs as $sub) {
              echo "<option value='". $sub['subject_id'] ."'>". $sub['subject_code'] ." - ". $sub['subject_desc'] ."</option>";
            }
          ?>
        </select>
        <div class="form-group">
          <label for="prog">Semester to Offer</label>
          <select name="sem" class="form-control"  required>
            <option value="">Select a Semester</option>
            <?php
              require 'inc/connection.php';
              $query = "SELECT * FROM semesters";
              $semesters = mysqli_query($connection,$query);
              foreach($semesters as $sem)
                echo '<option value="'.$sem['sem_id'].'">'.$sem['sem_name'].'</option>';
            ?>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="btnAddOff"><span class="glyphicon glyphicon-plus"></span> Teach Subject</button>
    </form>
  </div>
</div>
