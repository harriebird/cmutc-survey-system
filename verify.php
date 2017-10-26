<?php
session_start();
if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
  header('Location: home.php');
} else {
  if(!empty($_GET) && isset($_GET['email']) && isset($_GET['vcode'])) {
    require 'inc/connection.php';
    $email = $_GET['email'];
    $vcode = $_GET['vcode'];
    $query = "UPDATE users SET user_verified = 1 WHERE user_email='$email' AND user_vcode='$vcode' LIMIT 1";
    $result = mysqli_query($connection,$query);
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
      <?php
      if (isset($connection) && mysqli_affected_rows($connection) == 1) {
        echo '<h3>You have successfully verified your account.</h3><h5>You can now use it to login from this website.</h5>';
        include 'inc/logform.php';
      } elseif(isset($connection) && mysqli_affected_rows($connection) < 1)
        echo '<h3>Account verication failed.</h3><h5>Please check the verification code and the email. There is also a possibility that your account was already verified.</h5>';
      include 'inc/verform.php';
      ?>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
