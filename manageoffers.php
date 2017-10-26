<?php
	session_start();
	if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 2)
		header('Location: home.php');
	if(!empty($_GET) && isset($_GET['action']) && isset($_GET['oid'])) {
		if($_GET['action'] == 'delete') {
			require 'inc/connection.php';
			$query = "DELETE FROM subject_offers WHERE offer_id = ".$_GET['oid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Subject offer was successfully deleted.</h4>";
			else
				$message = "<h4 class='text-danger'>Subject offer was not successfully deleted.</h4><h5>The subject offer may still have students who enrolled in this subject offer.</h5>";
		}
		elseif($_GET['action'] == 'editoff') {
			require 'inc/connection.php';
			$query = "SELECT offer_id,subject_code,subject_desc FROM subject_offers INNER JOIN subjects ON subject_offers.subject_id=subjects.subject_id WHERE offer_id = ".$_GET['oid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			$edoff = mysqli_fetch_array($result);
		}

	}
	elseif(!empty($_POST) && isset($_POST['btnAddOff'])) {
		require 'inc/connection.php';
		$subject = $_POST['subject'];
		$sem = $_POST['sem'];
		$query = "SELECT * FROM subject_offers WHERE subject_id=".$subject." AND user_id=".$_SESSION['my_uid']." AND sem_id=".$sem."";
		$result = mysqli_query($connection,$query);
		if(mysqli_num_rows($result) > 0)
			$message = '<h4>Offer already exists in this semester.</h4>';
		else {
			$query = "INSERT INTO subject_offers(subject_id,user_id,offer_date,sem_id) VALUES('$subject','".$_SESSION['my_uid']."',NOW(),".$sem.")";
			$result = mysqli_query($connection,$query);
	    if(mysqli_affected_rows($connection) > 0)
	      $message = '<h4 class="text-success">You have successfully added a Subject Offer.</h4>';
	    else
	      $message = '<h4 class="text-danger">There is something wrong when adding the Subject Offer.</h4><h5>Please try again adding later.</h5>';
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnEditOff'])) {
		require 'inc/connection.php';
		$offid = $_POST['offid'];
		$sem = $_POST['sem'];
		$subject = $_POST['subject'];
		$query = "SELECT * FROM subject_offers WHERE subject_id=".$subject." AND user_id=".$_SESSION['my_uid']." AND sem_id=".$sem."";
		$result = mysqli_query($connection,$query);
		if(mysqli_num_rows($result) > 0)
			$message = '<h4 class="text-danger">Offer already exists.</h4>';
		else {
			$query = "UPDATE subject_offers SET subject_id ='$subject', sem_id=".$sem.", offer_date=NOW() WHERE offer_id = '$offid'";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Offer details were successfully modified.</h4>";
			else
				$message = "<h4 class='text-danger'>No changes were done on the Offer details.</h4>";
		}
	}
	elseif(!empty($_GET) && isset($_GET['query'])) {
		require 'inc/connection.php';
		$input = strtolower($_GET['query']);
		$query = "SELECT subject_offers.offer_id, subject_offers.subject_id, subjects.subject_code, subjects.subject_desc, subject_offers.offer_date FROM subject_offers INNER JOIN subjects ON subjects.subject_id = subject_offers.subject_id WHERE LOWER(CONCAT(subject_code,subject_desc)) LIKE '%".$input."%' AND user_id= ".$_SESSION['my_uid']." ORDER BY subject_code";
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
			    <h3 class="panel-title">Manage Subject Offers</h3>
			  </div>
			  <div class="panel-body">
					<form class="form-inline" role="form" method="get" action="manageoffers.php">
						<div class="btn-group">
							<a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
						</div>
						<div class="form-group">
							<input type="search" class="form-control input-sm" id="query" name="query" placeholder="Offer Search" required>
							<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
						</div>
					</form>
					<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
					<?php
						if(isset($_GET['action']) && $_GET['action'] == 'editoff')
							include 'inc/editoff.php';
						else
							include 'inc/addoff.php';
					?>
					<table class="table table-responsive table-striped table-hover">
					  <thead>
					    <tr>
					      <th>Subject Code</th>
								<th>Descriptive Title</th>
								<th>Date Offered</th>
								<th>Edit</th>
								<th>Delete</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
								if(!isset($offers)) {
									require 'inc/connection.php';
									$query = "SELECT offer_id,subject_offers.subject_id, offer_date,subject_code,subject_desc FROM subject_offers INNER JOIN subjects ON subject_offers.subject_id=subjects.subject_id WHERE user_id='".$_SESSION['my_uid']."'";
						      $offers = mysqli_query($connection,$query);
								}
					      foreach($offers as $offer) {
					        echo '<tr>';
					        echo '<td>'.$offer['subject_code'].'</td><td>'.$offer['subject_desc'].'</td><td>'.date_format(new DateTime($sub['date_added']),'F d, Y h:i A').'</td><td><a name="btnEditOff" href="manageoffers.php?action=editoff&oid='.$offer['offer_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a name="btnDelOff" href="manageoffers.php?action=delete&oid='.$offer['offer_id'].'" onclick="if (! confirm(\'Are you sure to delete this subject offer?\')) { return false; }"><span class="glyphicon glyphicon-trash"></span></a></td>';
					        echo '</tr>';
					      }
					    ?>
					  </tbody>
					</table>
			  </div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
