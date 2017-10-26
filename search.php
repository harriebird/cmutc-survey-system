<?php
  session_start();
  if(!empty($_GET) && isset($_GET['query'])) {
    require 'inc/connection.php';
    $input = strtolower($_GET['query']);
    $query = "SELECT user_id,CONCAT(user_fname,' ',user_lname) AS full_name,program_name,role_name FROM users INNER JOIN programs ON users.program_id = programs.program_id INNER JOIN roles ON users.role_id = roles.role_id WHERE LOWER(CONCAT(user_fname,user_mname,user_lname,user_email)) LIKE '%".$input."%' AND user_verified = 1";
    $seares = mysqli_query($connection,$query);
  }
?>
<!DOCTYPE html>
<html>
<?php include 'inc/head.php'; ?>
<body>
	<div class="container">
		<?php include 'inc/header.php'; ?>
		<article>
      <table class="table table-responsive table-striped table-hover">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Academic Program</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($seares)) {
              foreach($seares as $user)
                echo '<tr><td><a href="profile.php?uid='.$user['user_id'].'">'.$user['full_name'].'</a></td><td>'.$user['program_name'].'</td><td>'.$user['role_name'].'</td></tr>';
            }
          ?>
        </tbody>
      </table>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
