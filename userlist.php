<?php
  session_start();
  if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
  elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 3)
    header('Location: home.php');
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
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Program Name</th>
            <th>Verification</th>
            <th>Verified</th>
            <th>Last Login</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require 'inc/connection.php';
            $query = "SELECT user_id, user_email, CONCAT(user_lname, ', ' , user_fname, ' ', user_mname) AS full_name, program_name, user_vcode,user_verified, last_login FROM users INNER JOIN programs ON users.program_id = programs.program_id ORDER BY full_name";
            $result = mysqli_query($connection,$query);
            foreach($result as $user) {
              echo '<tr>';
              echo '<td>'.$user['user_id'].'</td><td>'.$user['full_name'].'</td><td>'.$user['user_email'].'</td><td>'.$user['program_name'].'</td><td>'.$user['user_vcode'].'</td><td>'.($user['user_verified']=='1'?'Y':'N').'</td><td>'.$user['last_login'].'</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
      <?php echo '<h3>Number of Registered Users: ' .mysqli_num_rows($result); ?>
    </article>
  </div>
</body>
</html>
