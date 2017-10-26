<?php
	session_start();
  if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	else {
		require 'inc/connection.php';
		$query = "SELECT * FROM users WHERE user_id=".$_SESSION['my_uid']."";
		$exst_info = mysqli_fetch_array(mysqli_query($connection,$query));
		if(!empty($_POST) && isset($_POST['btnEditProf'])) {
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$prog = $_POST['prog'];
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$query = "UPDATE users SET user_lname='$lname',user_fname='$fname',user_mname='$mname', program_id=".$prog.", user_bday='$bday', user_gender='$gender' WHERE user_id=".$_SESSION['my_uid']."";
			mysqli_query($connection,$query);
			if(mysqli_affected_rows($connection) > 0)
				$message = "<h4 class='text-success'>Changes were successfully applied.</h4>";
			else
				$message = "<h4 class='text-danger'>An error occured while saving changes.</h4>";
		}
		if(!empty($_POST) && isset($_POST['btnChaEmail'])) {
			$email = $_POST['email'];
			$query = "SELECT user_id FROM users WHERE user_email = '$email'";
			if(mysqli_num_rows(mysqli_query($connection,$query)) > 0)
				$message = "<h4 class='text-danger'>Cannot apply changes. The email is already existing on the database.</h4>";
			else {
				$query = "UPDATE users SET user_email = '$email' WHERE user_id =".$_SESSION['my_uid']."";
				if(mysqli_affected_rows($connection) > 0)
					$message = "<h4 class='text-success'>Changes were successfully applied.</h4>";
				else
					$message = "<h4 class='text-danger'>An error occured while saving changes.</h4>";
			}
		}
		if(!empty($_POST) && isset($_POST['btnChaPass'])) {
			$pass = md5($_POST['pass']);
			$newpass = md5($_POST['newpass']);
			$query = "SELECT user_id FROM users WHERE user_id =".$_SESSION['my_uid']." AND user_pass='$pass'";
			if(mysqli_num_rows(mysqli_query($connection,$query)) < 1)
				$message = "<h4 class='text-danger'>Cannot apply changes. You entered a wrong current password.</h4>";
			else {
				$query = "UPDATE users SET user_pass = '$newpass' WHERE user_id =".$_SESSION['my_uid']."";
				mysqli_query($connection,$query);
				if(mysqli_affected_rows($connection) > 0)
					$message = "<h4 class='text-success'>Changes were successfully applied. pass</h4>";
				else
					$message = "<h4 class='text-danger'>An error occured while saving changes.</h4>";
			}
		}
		elseif($_FILES) {
	    $dir = "img/propic/";
	    $_FILES['filename']['name'] = $_SESSION['my_uid'] . ".png";
	    $name = $dir . $_FILES['filename']['name'];
	    $type = substr($_FILES['filename']['type'],0,5);
	    if($type == 'image')
	      if(move_uploaded_file($_FILES['filename']['tmp_name'], $name))
	        $message = '<h4 class="text-success">Upload succesful. :)</h4>';
	      else
	        $message = '<h4 class="text-danger">Upload failed. Please try again</h4>';
	    else
	      $message = '<h4 class="text-danger">File type is not allowed. Please try again</h4>';
	  }
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
					<h3 class="panel-title">Edit Profile</h3>
				</div>
				<div class="panel-body">
					<a class="btn btn-default" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
					<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
					<div class="row">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-5">
									<?php
									if(isset($_SESSION) && file_exists('img/propic/'.$_SESSION['my_uid'].'.png'))
									echo '<img src="img/propic/'.$_SESSION['my_uid'].'.png" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="My Profile Pic">';
									elseif(isset($_SESSION) && file_exists('img/propic/'.$_SESSION['my_uid'].'.jpg'))
									echo '<img src="img/propic/'.$_SESSION['my_uid'].'.jpg" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="My Profile Pic"';
									elseif(isset($_SESSION) && file_exists('img/propic/'.$_SESSION['my_uid'].'.gif'))
									echo '<img src="img/propic/'.$_SESSION['my_uid'].'.gif" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="My Profile Pic"';
									else
									echo '<img src="img/propic/nopic.png" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="No Picture">';
									?>
								</div>
								<div class="col-lg-6">
									<form method="post" action="editprofile.php" enctype="multipart/form-data">
										<label for="filename">Change Profile Picture</label>
										<input type="file" name="filename" size="10">
										<button type="submit" class="btn btn-success" value="Upload"><span class="glyphicon glyphicon-upload"></span> Upload</button>
									</form>
								</div>
							</div>
							<form role="form" class="form-default" method="post" action="editprofile.php">
								<div class="form-group">
									<label for="lname">Last Name</label>
									<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $exst_info['user_lname'];?>" placeholder="Enter Last Name" required>
								</div>
								<div class="form-group">
									<label for="fname">First Name</label>
									<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $exst_info['user_fname'];?>" placeholder="Enter First Name" required>
								</div>
								<div class="form-group">
									<label for="mname">Middle Name</label>
									<input type="text" class="form-control" id="mname" name="mname" value="<?php echo $exst_info['user_mname'];?>" placeholder="Enter Middle Name" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="prog">Academic Program</label>
									<select name="prog" class="form-control"  required>
										<option value="">Select a Program here</option>
										<?php
										require 'inc/connection.php';
										$query = "SELECT program_id,program_name FROM programs ORDER BY program_name";
										$result = mysqli_query($connection,$query);
										foreach($result as $prog) {
											echo "<option value='". $prog['program_id'] ."'>". $prog['program_name']."</option>";
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="bday">Birthday (YYYY-MM-DD)</label>
									<input type="date" class="form-control" id="bday" name="bday" value="<?php echo $exst_info['user_bday'];?>" placeholder="YYYY-MM-DD" required>
								</div>
								<div class="form-group">
									<label for="gender">Gender</label>
									<select name="gender" class="form-control" required>
										<option value="">Select a Gender</option>
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" name="btnEditProf" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-ok"></span> Apply</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Change Email address</h3>
				</div>
				<div class="panel-body text-center">
					<form class="form-inline" role="form" method="post" action="editprofile.php">
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $exst_info['user_email'];?>" placeholder="user@domain.com" required>
						</div>
						<input type="number" class="hidden" name="userid" value="<?php echo $exst_info['user_id']; ?>">
						<button type="submit" class="btn btn-warning" name="btnChaEmail"><span class="glyphicon glyphicon-ok"></span> Apply</button>
					</form>
				</div>
			</div>
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">Change password</h3>
				</div>
				<div class="panel-body text-center">
					<form class="form-inline" role="form" method="post" action="editprofile.php">
						<div class="form-group">
							<label for="pass">Current Password</label>
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="newpass">New Password</label>
							<input type="password" class="form-control" id="newpass" name="newpass" placeholder="Password" required>
						</div>
						<input type="number" class="hidden" name="userid" value="<?php echo $exst_info['user_id']; ?>">
						<button type="submit" class="btn btn-danger" name="btnChaPass"><span class="glyphicon glyphicon-ok"></span> Change Password</button>
					</form>
				</div>
			</div>
	</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
