<?php
  session_start();
  if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
  if(!empty($_GET) && isset($_GET['action']) && isset($_GET['oid'])) {
		if($_GET['action'] == 'delist') {
			require 'inc/connection.php';
			$query = "DELETE FROM offer_students WHERE offstud_id = ".$_GET['oid']." AND user_id=".$_SESSION['my_uid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>You were successfully delisted.</h4>";
			else
				$message = "<h4 class='text-danger'>You were not successfully delisted.</h4>";
		}
		elseif($_GET['action'] == 'enroll') {
			require 'inc/connection.php';
  		$oid = $_GET['oid'];
  		$query = "SELECT * FROM offer_students WHERE offer_id=".$oid." AND user_id=".$_SESSION['my_uid']."";
  		$result = mysqli_query($connection,$query);
  		if(mysqli_num_rows($result) > 0)
  			$message = '<h4 class="text-danger">You are already enrolled to this subject.</h4>';
      else {
        $query = "INSERT INTO offer_students(offer_id, user_id, enlist_date) VALUES('".$_GET['oid']."','".$_SESSION['my_uid']."', NOW())";
  			$result = mysqli_query($connection,$query);
        if(mysqli_affected_rows($connection) > 0)
  	      $message = '<h4 class="text-success">You have successfully added a Subject Offer.</h4>';
  	    else
  	      $message = '<h4 class="text-danger">There is something wrong when adding the Subject Offer.</h4><h5>Please try again adding later.</h5>';
      }
		}
	}
  elseif(!empty($_GET) && isset($_GET['query'])) {
		require 'inc/connection.php';
		$input = strtolower($_GET['query']);
    $query = "SELECT subject_offers.offer_id, subject_code, subject_desc, users.user_id, CONCAT(users.user_fname,' ',users.user_lname) AS tutor_name FROM subject_offers INNER JOIN users ON subject_offers.user_id=users.user_id INNER JOIN subjects ON subject_offers.subject_id=subjects.subject_id WHERE LOWER(CONCAT(subject_code,subject_desc,users.user_fname,users.user_lname)) LIKE '%".$input."%' ORDER BY subject_desc";
    $offers = mysqli_query($connection,$query);
		if(mysqli_num_rows($offers) > 0)
			$message = "<h4 class='text-success'>Found ".mysqli_num_rows($offers)." subject offer(s).</h4>";
		else
			$message = "<h4 class='text-danger'>No subjects offers found.</h4>";
	}
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
			    <h3 class="panel-title">Enroll Subjects</h3>
			  </div>
			  <div class="panel-body">
          <form class="form-inline" role="form" method="get" action="enrolsubs.php">
    				<div class="btn-group">
    					<a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    					<a class="btn btn-success btn-sm" href="enrolsubs.php?action=enroll"><span class="glyphicon glyphicon-book"></span> Enroll Subject</a>
    				</div>
    				<div class="form-group">
    					<input type="search" class="form-control input-sm" id="query" name="query" placeholder="Offered Subject Search" required>
              <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
    				</div>
    			</form>
          <?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
          <?php
          if((isset($_GET['action']) && ($_GET['action'] == 'enroll')) || isset($_GET['query']))
            include 'inc/substbl.php';
          else
            include 'inc/enrolledtbl.php';
          ?>
			  </div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
