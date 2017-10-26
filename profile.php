<?php
  session_start();
  if(!empty($_GET) && isset($_GET['uid']) && is_numeric($_GET['uid'])) {
    require 'inc/connection.php';
    $query = "SELECT user_id, user_fname, user_mname, user_fname, user_lname, user_bday, date_reg, users.role_id, user_gender,program_name,college_name,role_name FROM users INNER JOIN programs ON users.program_id = programs.program_id INNER JOIN colleges ON programs.college_id = colleges.college_id INNER JOIN roles ON users.role_id = roles.role_id WHERE user_id = '".$_GET['uid']."' AND user_verified = 1 LIMIT 1";
    $result = mysqli_query($connection,$query);
    $user_info = mysqli_fetch_array($result);
  }
  elseif(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
    require 'inc/connection.php';
    $query = "SELECT *,program_name,college_name,role_name FROM users INNER JOIN programs ON users.program_id = programs.program_id INNER JOIN colleges ON programs.college_id = colleges.college_id INNER JOIN roles ON users.role_id = roles.role_id WHERE user_id = '".$_SESSION['my_uid']."' LIMIT 1";
    $result = mysqli_query($connection,$query);
    $user_info = mysqli_fetch_array($result);
  }
?>
<!DOCTYPE html>
<html>
<?php include 'inc/head.php'; ?>
<body>
	<div class="container">
		<?php include 'inc/header.php'; ?>
		<article>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Personal Information</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-5">
              <?php
                if(isset($user_info) && file_exists('img/propic/'.$user_info['user_id'].'.png'))
                  echo '<img src="img/propic/'.$user_info['user_id'].'.png" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="'.$user_info['user_fname'].' '.$user_info['user_mname'].' '.$user_info['user_lname'].'">';
                elseif(isset($user_info) && file_exists('img/propic/'.$user_info['user_id'].'.jpg'))
                  echo '<img src="img/propic/'.$user_info['user_id'].'.jpg" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="'.$user_info['user_fname'].' '.$user_info['user_mname'].' '.$user_info['user_lname'].'">';
                elseif(isset($user_info) && file_exists('img/propic/'.$user_info['user_id'].'.gif'))
                  echo '<img src="img/propic/'.$user_info['user_id'].'.gif" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="'.$user_info['user_fname'].' '.$user_info['user_mname'].' '.$user_info['user_lname'].'">';
                else
                  echo '<img src="img/propic/nopic.png" class="img-circle img-responsive animated bounce" width="274px" height="274px" alt="No Picture">';
              ?>
            </div>
            <div class="col-lg-7">
              <?php
                if(isset($user_info)) {
                  echo '<h2><b>'.$user_info['user_fname'].' '.$user_info['user_mname'].' '.$user_info['user_lname'].'</b></h2>';
                  echo '<h3>' . ($user_info['user_gender'] == 'M'?'Male':'Female').', '.((new DateTime($user_info['user_bday']))->diff(new DateTime('today'))->y).' years old</h3>';
                  echo '<h3>Birthday: '.date_format(new DateTime($user_info['user_bday']),'F d, Y').'</h3>';
                  echo '<h3>Member since: '.date_format(new DateTime($user_info['date_reg']),'F d, Y').'</h3>';
                  echo '<h3>Academic Program: '.$user_info['program_name'].'</h3>';
                  echo '<h3>College: '.$user_info['college_name'].'</h3>';
                  echo '<h3>Status: '.$user_info['role_name'].'</h3>';
                } else {
                  echo '<h3>User Profile not found.</h3>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
        if(isset($user_info) && $user_info['role_id'] != 1)
          include 'inc/techtbl.php';
      ?>
      <?php if(isset($user_info)) include 'inc/studtbl.php'; ?>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
