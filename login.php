<?php
	session_start();
	if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
		header('Location: home.php');
	} else {
		if(!empty($_POST) && isset($_POST['btnLogin'])) {
			require 'inc/connection.php';
			$email = $_POST['email'];
			$pass =  md5($_POST['pword']);
			$query="SELECT user_id,role_id FROM users WHERE user_email='$email' AND user_pass='$pass' AND user_verified = 1 LIMIT 1";
			$result = mysqli_query($connection,$query);
			if(mysqli_num_rows($result) == 1){
				$user = mysqli_fetch_array($result);
				$query="UPDATE users SET last_login = NOW() WHERE user_id='".$user['user_id']."' AND user_verified = 1 LIMIT 1";
					mysqli_query($connection,$query);
				session_start();
				$_SESSION['my_uid'] = $user['user_id'];
				$_SESSION['my_role'] = $user['role_id'];
				header('Location: home.php');
			}
			else
				$message = '<h3>Invalid login credentials provided.</h3><h5>Please try again to login.</h5>';
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
			<?php include 'inc/logform.php'; ?>
			<?php include 'inc/regform.php'; ?>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
