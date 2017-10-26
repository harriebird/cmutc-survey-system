<div class="panel panel-success animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Subject</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="managesubs.php">
      <h5>This will enable a user to modify the subject info.</h5>
      <div class="form-group">
        <label for="subcode">Subject Code</label>
        <input type="text" class="form-control" id="subcode" name="subcode" placeholder="SUB11" value="<?php echo $sub['subject_code']; ?>" required>
      </div>
      <div class="form-group">
        <label for="subdesc">Descriptive Title</label>
        <input type="text" class="form-control" id="subdesc" name="subdesc" placeholder="Example Subject" value="<?php echo $sub['subject_desc']; ?>" required>
      </div>
        <input type="number" class="hidden" name="subid" value="<?php echo $_GET['sid']; ?>">
      <button type="submit" class="btn btn-success" name="btnEditSub"><span class="glyphicon glyphicon-ok"></span> Apply</button>
    </form>
  </div>
</div>
