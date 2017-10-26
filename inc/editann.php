<div class="panel panel-success animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">Edit an Announcement</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-default" role="form" method="post" action="manageannouns.php">
      <h5>This will enable a user to modify the Announcement info.</h5>
      <div class="form-group">
        <label for="subcode">Announcement Title</label>
        <input type="text" class="form-control" name="title" placeholder="Announcement Title" value="<?php echo $ann['post_title']; ?>" required>
      </div>
      <div class="form-group">
        <label for="content">Announcement Content</label>
        <textarea type="text" name="content"class="form-control" rows="6" placeholder="Details of the Announcement" required><?php echo $ann['post_details']; ?></textarea>
      </div>
      <input type="number" class="hidden" name="annid" value="<?php echo $_GET['aid']; ?>">
      <button type="submit" class="btn btn-success btn-block" name="btnEditAnn"><span class="glyphicon glyphicon-ok"></span> Apply</button>
    </form>
  </div>
</div>
