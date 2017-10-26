<div class="panel panel-primary animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">New Semester</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="managesems.php">
      <h5>Please provide the semester name and its details.</h5>
      <h5>Example Name: <b>1st Semester SY 2015-2016</b></h5>
      <div class="form-group">
        <label for="subcode">Semester Name</label>
        <input type="text" class="form-control" id="semname" name="semname" placeholder="1st Semester SY YYYY-YYYY" required>
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
        <input type="date" class="form-control" id="datestart" name="datestart" placeholder="YYYY-MM-DD" required>
      </div>
      <div class="form-group">
        <label for="subdesc">Date End</label>
        <input type="date" class="form-control" id="dateend" name="dateend" placeholder="YYYY-MM-DD" required>
      </div>
      <br><button type="submit" class="btn btn-primary" name="btnAddSem"><span class="glyphicon glyphicon-plus"></span> Add Semester</button>
    </form>
  </div>
</div>
