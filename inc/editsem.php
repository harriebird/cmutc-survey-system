<div class="panel panel-success animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Semester</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="managesems.php">
      <h5>Please provide the semester name and its details.</h5>
      <h5>Example Name: <b>1st Semester SY 2015-2016</b></h5>
      <div class="form-group">
        <label for="subcode">Semester Name</label>
        <input type="text" class="form-control" id="semname" name="semname" placeholder="1st Semester SY YYYY-YYYY" value="<?php echo $sem['sem_name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="prog">Semester</label>
        <select name="sem" class="form-control"  required>
          <option value="">Select a Semester</option>
          <option value="1">First Semester</option>
          <option value="2">Second Semester</option>
        </select>
      </div>
      <div class="form-group">
        <label for="subdesc">Date Start</label>
        <input type="date" class="form-control" id="datestart" name="datestart" placeholder="YYYY-MM-DD" value="<?php echo $sem['date_start']; ?>" required>
      </div>
      <div class="form-group">
        <label for="subdesc">Date End</label>
        <input type="date" class="form-control" id="dateend" name="dateend" placeholder="YYYY-MM-DD" value="<?php echo $sem['date_end']; ?>" required>
      </div>
        <input type="number" class="hidden" name="semid" value="<?php echo $_GET['sid']; ?>">
      <br><button type="submit" class="btn btn-success" name="btnEditSem"><span class="glyphicon glyphicon-ok"></span> Apply</button>
    </form>
  </div>
</div>
