<?php
	session_start();
	if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 2)
		header('Location: home.php');
	if(!empty($_GET) && isset($_GET['action']) && isset($_GET['sid'])) {
		if($_GET['action'] == 'delete') {
			require 'inc/connection.php';
			$query = "DELETE FROM subjects WHERE subject_id = ".$_GET['sid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Subject was successfully deleted.</h4>";
			else
				$message = "<h4 class='text-danger'>Subject was not successfully deleted.</h4><h5>The subject may be currently offered by other tutors.</h5>";
		}
		elseif($_GET['action'] == 'editsub') {
			require 'inc/connection.php';
			$query = "SELECT * FROM subjects WHERE subject_id = ".$_GET['sid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			$sub = mysqli_fetch_array($result);
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnAddSub'])) {
		require 'inc/connection.php';
		$subcode = $_POST['subcode'];
		$subdesc = $_POST['subdesc'];
		$query = "SELECT subjects.subject_id FROM subjects WHERE LOWER(subject_code)=LOWER('".$subcode."') AND LOWER(subject_desc) = LOWER('".$subdesc."')";
		if(mysqli_num_rows(mysqli_query($connection,$query)) > 0)
			$message = "<h4 class='text-danger'>Cannot add the subject. It is already existing on the database.</h4>";
		else {
			$query = "INSERT INTO subjects(subject_code,subject_desc,date_added) VALUES('$subcode', '$subdesc', NOW())";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Subject was successfully added.</h4>";
			else
				$message = "<h4 class='text-danger'>An error occured while adding the subject.</h4>";
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnEditSub'])) {
		require 'inc/connection.php';
		$subid = $_POST['subid'];
		$subcode = $_POST['subcode'];
		$subdesc = $_POST['subdesc'];
		$query = "SELECT subjects.subject_id FROM subjects WHERE LOWER(subject_code)=LOWER('".$subcode."') AND LOWER(subject_desc) = LOWER('".$subdesc."')";
		if(mysqli_num_rows(mysqli_query($connection,$query)) > 0)
			$message = "<h4 class='text-danger'>Cannot edit the subject. The details provided is already existing on the database.</h4>";
		else {
			$query = "UPDATE subjects SET subject_code ='$subcode',subject_desc='$subdesc', date_added=NOW() WHERE subject_id='$subid'";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Subject details were successfully modified.</h4>";
			else
				$message = "<h4 class='text-danger'>No changes were done on the subject details.</h4>";
		}
	}
	elseif(!empty($_GET) && isset($_GET['query'])) {
		require 'inc/connection.php';
		$input = $_GET['query'];
		$query = "SELECT * FROM subjects WHERE LOWER(CONCAT(subject_code,subject_desc)) LIKE '%".$input."%' ORDER BY subject_code";
		$subjects = mysqli_query($connection,$query);
		if(mysqli_num_rows($subjects) > 0)
			$message = "<h4 class='text-success'>Found ".mysqli_num_rows($subjects)." subject(s).</h4>";
		else
			$message = "<h4 class='text-danger'>No subjects found.</h4>";
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
					<h3 class="panel-title">Manage Subjects</h3>
				</div>
				<div class="panel-body">
					<form class="form-inline" role="form" method="get" action="managesubs.php">
						<div class="btn-group">
							<a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
							<a class="btn btn-success btn-sm" href="managesubs.php?action=addsub"><span class="glyphicon glyphicon-plus"></span> Add Subject</a>
						</div>
	          <div class="form-group">
	            <input type="search" class="form-control input-sm" id="query" name="query" placeholder="Subject Search" required>
							<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
	          </div>

	        </form>
				<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
				<?php
					if(isset($_GET['action']) && $_GET['action'] == 'addsub')
						include 'inc/addsub.php';
					elseif(isset($_GET['action']) && $_GET['action'] == 'editsub')
						include 'inc/editsub.php';
					else
						include 'inc/subtbl.php';
				?>
				</div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
