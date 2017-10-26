<div class="panel panel-primary animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Add an Announcement</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-default" role="form" method="post" action="manageannouns.php">
      <h5>This will enable the user to post announcements on the homepage.</h5>
      <div class="form-group">
        <label for="subcode">Announcement Title</label>
        <input type="text" class="form-control" id="subcode" name="title" placeholder="Announcement Title" required>
      </div>
      <div class="form-group">
        <label for="content">Announcement Content</label>
        <textarea type="text" name="content"class="form-control" rows="6" placeholder="Details of the Announcement" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="btnAddAnn"><span class="glyphicon glyphicon-plus"></span> Add Announcement</button>
    </form>
  </div>
</div>
