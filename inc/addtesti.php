<div class="panel panel-danger wow slideInLeft">
  <div class="panel-heading">
    <h3 class="panel-title">Post a Comment or Testimonial</h3>
  </div>
  <div class="panel-body">
    <form class="form-default" role="form" method="post" action="offers.php?oid=<?php echo $offer_info['offer_id'] ?>">
      <h5>Add you testimonial or comment about this subject offer.</h5>
      <div class="form-group">
        <textarea type="text" name="comment" class="form-control" rows="4" placeholder="Your comment on testimonial here." required></textarea>
      </div>
      <input type="hidden" name="userid" value="<?php echo $_SESSION['my_uid'] ?>">
      <input type="hidden" name="offerid" value="<?php echo $offer_info['offer_id'] ?>">
      <button type="submit" class="btn btn-success btn-block" name="btnComment"><span class="glyphicon glyphicon-bullhorn"></span> Post Comment</button>
    </form>
  </div>
</div>
