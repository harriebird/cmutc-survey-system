<?php
	session_start();
	if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
		header('Location: home.php');
	} else {
		if(!empty($_POST) && isset($_POST['regButton'])) {
			require 'inc/connection.php';
			$email = $_POST['email'];
			$pass = md5($_POST['pass']);
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$gender = $_POST['gender'];
			$prog = $_POST['prog'];
			$bday = $_POST['bday'];
			$query = "SELECT user_id FROM users WHERE user_email = '$email'";
			$result = mysqli_query($connection,$query);
			$registered = 0;
			if(mysqli_num_rows($result) < 1) {
				$vcode = mt_rand(100000,99999999);
				$query = "INSERT INTO users(user_email, user_pass, user_lname, user_fname, user_mname, user_gender, user_bday, program_id, user_verified, user_vcode, role_id, date_reg)
								VALUES('$email','$pass','$lname','$fname','$mname','$gender','$bday','$prog',0,'$vcode',1,NOW())";
				$result = mysqli_query($connection,$query);
				if (mysqli_affected_rows($connection) > 0) {
					$website = 'localhost';
					$subject = 'Please verify your account at '.$website.'.';
					$headers = 'From: harriebird@yahoo.com';
					$message = 'Hi there '.$fname.'!\n You can verify your account by visiting this link:\n<a href="'.$website.'/verify.php?email='.$email.'&vcode='.$vcode.'">'.$website.'/verify.php?email='.$email.'&vcode='.$vcode.'</a>';
					mail($email,$subject,$message,$headers);
					header('Location: verify.php');
				}
			}
			else
				$message = '<h3>The email already exists here.</h3><h5>Please use another email address in order to successfully register here.</h5>';
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
			<?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
			<?php include 'inc/regform.php'; ?>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
