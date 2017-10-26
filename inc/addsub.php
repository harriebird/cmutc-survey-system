<div class="panel panel-primary animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Add a Subject</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="managesubs.php">
      <h5>Please provide the subject code and the descriptive title of the subject.</h5>
      <div class="form-group">
        <label for="subcode">Subject Code</label>
        <input type="text" class="form-control" id="subcode" name="subcode" placeholder="SUB11" required>
      </div>
      <div class="form-group">
        <label for="subdesc">Descriptive Title</label>
        <input type="text" class="form-control" id="subdesc" name="subdesc" placeholder="Example Subject" required>
      </div>
      <button type="submit" class="btn btn-primary" name="btnAddSub"><span class="glyphicon glyphicon-plus"></span> Add Subject</button>
    </form>
  </div>
</div>
