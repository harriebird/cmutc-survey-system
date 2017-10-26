<?php
	session_start();
	if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 2)
		header('Location: home.php');
	if(!empty($_GET) && isset($_GET['action']) && isset($_GET['sid'])) {
		if($_GET['action'] == 'delete') {
			require 'inc/connection.php';
			$query = "DELETE FROM semesters WHERE sem_id = ".$_GET['sid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Semester was successfully deleted.</h4>";
			else
				$message = "<h4 class='text-danger'>Semester was not successfully deleted.</h4><h5>The semester may have subjects offers and students.";
		}
		elseif($_GET['action'] == 'editsem') {
			require 'inc/connection.php';
			$query = "SELECT * FROM semesters WHERE sem_id = ".$_GET['sid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			$sem = mysqli_fetch_array($result);
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnAddSem'])) {
		require 'inc/connection.php';
    $semname = $_POST['semname'];
    $sem = $_POST['sem'];
    $datestart= $_POST['datestart'];
    $dateend = $_POST['dateend'];
		$query = "SELECT sem_id FROM semesters WHERE LOWER(sem_name)=LOWER('".$semname."')";
		if(mysqli_num_rows(mysqli_query($connection,$query)) > 0)
			$message = "<h4 class='text-danger'>Cannot add this semester. It is already existing on the database.</h4>";
		else {
			$query = "INSERT INTO semesters(sem_name,sem_num,date_start,date_end,date_added) VALUES('$semname', $sem, '$datestart', '$dateend', NOW())";
			mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Semester was successfully added.</h4>";
			else
				$message = "<h4 class='text-danger'>An error occured while adding the semester.</h4>";
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnEditSem'])) {
		require 'inc/connection.php';
    $semid = $_POST['semid'];
    $semname = $_POST['semname'];
    $sem = $_POST['sem'];
    $datestart= $_POST['datestart'];
    $dateend = $_POST['dateend'];
		$query = "SELECT semesters.sem_id FROM semesters WHERE LOWER(sem_name)=LOWER('".$semname."')";
		if(mysqli_num_rows(mysqli_query($connection,$query)) > 0)
			$message = "<h4 class='text-danger'>Cannot edit the semester. The details provided is already existing on the database.</h4>";
		else {
			$query = "UPDATE semesters SET sem_name='$semname',sem_num=".$sem.",date_start='$datestart',date_end='$dateend' WHERE sem_id=".$semid."";
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
					<form class="form-inline" role="form" method="get" action="managesems.php">
						<div class="btn-group">
							<a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
							<a class="btn btn-success btn-sm" href="managesems.php?action=addsem"><span class="glyphicon glyphicon-plus"></span> New Semester</a>
						</div>
	          <div class="form-group">
	            <input type="search" class="form-control input-sm" id="query" name="query" placeholder="Subject Search" required>
							<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
	          </div>
	        </form>
				<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
				<?php
					if(isset($_GET['action']) && $_GET['action'] == 'addsem')
						include 'inc/addsem.php';
					elseif(isset($_GET['action']) && $_GET['action'] == 'editsem')
						include 'inc/editsem.php';
					else
						include 'inc/semtbl.php';
				?>
				</div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
