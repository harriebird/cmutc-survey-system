<div class="col-lg-6  animated fadeInRight delay 1s">

  <a class="btn btn-success btn-lg btn-block" href="managesubs.php"><span class="glyphicon glyphicon-education"></span> Manage Subjects</a>
  <a class="btn btn-success btn-lg btn-block" href="manageannouns.php"><span class="glyphicon glyphicon-bullhorn"></span> Manage Announcements</a>
  <a class="btn btn-success btn-lg btn-block" href="manageoffers.php"><span class="glyphicon glyphicon-list-alt"></span> Manage Subject Offers</a>
  <?php
    if($_SESSION['my_role'] == 3) {
      echo '<a class="btn btn-success btn-lg btn-block" href="managesems.php"><span class="glyphicon glyphicon-calendar"></span> Manage Semesters</a>';
      echo '<a class="btn btn-success btn-lg btn-block" href="manageusers.php"><span class="glyphicon glyphicon-credit-card"></span> Manage User Role</a>';
    }
  ?>
</div>
