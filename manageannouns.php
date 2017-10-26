<?php
	session_start();
	if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 2)
		header('Location: home.php');
	if(!empty($_GET) && isset($_GET['action']) && isset($_GET['aid'])) {
		if($_GET['action'] == 'delete') {
			require 'inc/connection.php';
			$query = "DELETE FROM posts WHERE post_id = ".$_GET['aid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Announcement was successfully deleted.</h4>";
			else
				$message = "<h4>Announcement was not deleted or it doesn't exist.</h4>";
		}
		elseif($_GET['action'] == 'editann') {
			require 'inc/connection.php';
			$query = "SELECT * FROM posts WHERE post_id = ".$_GET['aid']." LIMIT 1";
			$result = mysqli_query($connection,$query);
			$ann = mysqli_fetch_array($result);
		}
		elseif($_GET['action'] == 'enable') {
			require 'inc/connection.php';
			$query = "UPDATE posts SET post_publish = 1 WHERE post_id = ".$_GET['aid']." LIMIT 1";
			mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
	      $message = '<h4 class="text-success">You have successfully made the announcement visible.</h4>';
		}
		elseif($_GET['action'] == 'disable') {
			require 'inc/connection.php';
			$query = "UPDATE posts SET post_publish = 0 WHERE post_id = ".$_GET['aid']." LIMIT 1";
			mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
	      $message = '<h4 class="text-success">You have successfully made the announcement hidden.</h4>';
		}
	}
	elseif(!empty($_POST) && isset($_POST['btnAddAnn'])) {
		require 'inc/connection.php';
		$title = $_POST['title'];
		$content = $_POST['content'];
		$query = "INSERT INTO posts(post_title,post_details,user_id,post_date,post_publish) VALUES('$title', '$content','".$_SESSION['my_uid']."', NOW(),0)";
		$result = mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection) > 0)
      $message = '<h4 class="text-success">You have successfully added an Announcement.</h4>';
    else
      $message = '<h4 class="text-danger">There is something wrong when adding the Announcement.</h4><h5>Please try again adding an Announcement later.</h5>';
	}
	elseif(!empty($_POST) && isset($_POST['btnEditAnn'])) {
		require 'inc/connection.php';
		$annid = $_POST['annid'];
		$anntit = $_POST['title'];
		$anndets = $_POST['content'];
		$query = "UPDATE posts SET post_title ='$anntit', post_details='$anndets', post_date=NOW() WHERE post_id = '$annid'";
		$result = mysqli_query($connection,$query);
		if(mysqli_affected_rows($connection) > 0)
			$message = "<h4 class='text-success'>Announcement details were successfully modified.</h4>";
		else
			$message = "<h4 class='text-danger'>No changes were done on the Announcement details.</h4>";
	}
	elseif(!empty($_GET) && isset($_GET['query'])) {
		require 'inc/connection.php';
		$input = strtolower($_GET['query']);
		if($_SESSION['my_role']==3)
			$query = "SELECT post_id, post_title, post_date, posts.user_id,user_fname FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE LOWER(post_title) LIKE '%".$input."%' ORDER BY post_date DESC";
		else
			$query = "SELECT * FROM posts WHERE LOWER(post_title) LIKE '%".$input."%' AND user_id = '".$_SESSION['my_uid']."' ORDER BY post_date DESC";
		$posts = mysqli_query($connection,$query);
		if(mysqli_num_rows($posts) > 0)
			$message = "<h4 class='text-success'>Found ".mysqli_num_rows($posts)." announcement(s).</h4>";
		else
			$message = "<h4 class='text-danger'>No announcements found.</h4>";
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
			    <h3 class="panel-title">Manage Announcements</h3>
			  </div>
			  <div class="panel-body">
					<form class="form-inline" role="form" method="get" action="manageannouns.php">
						<div class="btn-group">
							<a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
							<a class="btn btn-success btn-sm" href="manageannouns.php?action=addann"><span class="glyphicon glyphicon-plus"></span> Add Announcement</a>
						</div>
						<div class="form-group">
							<input type="search" class="form-control input-sm" id="query" name="query" placeholder="Announcement Search" required>
							<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
						</div>
					</form>
					<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
					<?php
						if(isset($_GET['action']) && $_GET['action'] == 'addann')
							include 'inc/addann.php';
						elseif(isset($_GET['action']) && $_GET['action'] == 'editann')
							include 'inc/editann.php';
						else
							include 'inc/anntbl.php';
					?>
			  </div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
