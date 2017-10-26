<?php session_start();
  if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
?>
<!DOCTYPE html>
<html>
<?php include 'inc/head.php'; ?>
<body>
	<div class="container">
		<?php include 'inc/header.php'; ?>
		<article>
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">What do you want to do?</h3>
        </div>
        <div class="panel-body">
          <div class ="row">
            <div class="col-lg-6  animated fadeInLeft delay 1s">
              <a class="btn btn-success btn-lg btn-block" href="profile.php"><span class="glyphicon glyphicon-eye-open"></span> View Profile</a>
              <a class="btn btn-success btn-lg btn-block" href="editprofile.php"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>
              <a class="btn btn-success btn-lg btn-block" href="enrolsubs.php"><span class="glyphicon glyphicon-book"></span> Enroll Subject</a>
              <a class="btn btn-success btn-lg btn-block" href="viewreps.php"><span class="glyphicon glyphicon-signal"></span> View Reports</a>
            </div>
            <?php if($_SESSION['my_role'] != 1) include 'inc/privacc.php'; ?>
          </div>
        </div>
      </div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
