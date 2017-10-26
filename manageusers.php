<?php
  session_start();
  if(empty($_SESSION) && !isset($_SESSION['my_uid']))
    header('Location: index.php');
	elseif(isset($_SESSION['my_role']) && $_SESSION['my_role'] < 3)
		header('Location: home.php');
  if(!empty($_GET) && isset($_GET['query'])) {
    require 'inc/connection.php';
    $input = strtolower($_GET['query']);
    $query = "SELECT user_id, CONCAT(user_fname, ' ', user_lname) AS full_name, role_name FROM users INNER JOIN roles ON users.role_id = roles.role_id WHERE LOWER(CONCAT(user_fname,user_mname,user_lname,user_email)) LIKE '%".$input."%' ORDER BY full_name";
    $users = mysqli_query($connection,$query);
    if(mysqli_num_rows($users) > 0)
			$message = "<h4 class='text-success'>Found ".mysqli_num_rows($users)." user(s).</h4>";
		else
			$message = "<h4 class='text-danger'>No users found.</h4>";
  }
  elseif(!empty($_GET) && isset($_GET['uid']) && isset($_GET['role'])) {
		require 'inc/connection.php';
		$uid = $_GET['uid'];
		$role = $_GET['role'];
		$query = "UPDATE users SET role_id ='$role' WHERE user_id='$uid'";
		$result = mysqli_query($connection,$query);
		if(mysqli_affected_rows($connection) > 0)
			$message = "<h4 class='text-success'>User role successfully updated.</h4>";
		else
			$message = "<h4 class='text-danger'>No changes done on the user role.</h4>";
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
			    <h3 class="panel-title">Manage User Role</h3>
			  </div>
			  <div class="panel-body">
          <form class="form-inline" role="form" method="get" action="manageusers.php">
            <div class="btn-group">
              <a class="btn btn-default btn-sm" href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
            </div>
            <div class="form-group">
              <input type="search" class="form-control input-sm" id="query" name="query" placeholder="Search a User" required>
              <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
            </div>
          </form>
          <?php if(isset($message)) echo '<div class="well well-sm">'.$message.'</div>';?>
          <table class="table table-responsive table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>User Role</th>
                <th>Update User Role</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(!isset($users)){
                  require 'inc/connection.php';
              		$query = "SELECT user_id, CONCAT(user_fname, ' ', user_lname) AS full_name, role_name FROM users INNER JOIN roles ON users.role_id = roles.role_id ORDER BY full_name";
              		$users = mysqli_query($connection,$query);
                }
                $query2 = "SELECT * FROM roles";
                $roles = mysqli_query($connection,$query2);
                foreach($users as $user) {
                  echo '<tr>';
                  echo '<td>'.$user['user_id'].'</td><td><a href="profile.php?uid='.$user['user_id'].'">'.$user['full_name'].'</a></td><td>'.$user['role_name'].'</td>';
                  echo '<td>';
                  include 'inc/roles.php';
                  echo '</td>';
                  echo '</tr>';
                }
              ?>
            </tbody>
          </table>
			  </div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
