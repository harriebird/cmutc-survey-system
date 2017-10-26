<?php
  session_start();
  if(!empty($_GET) && isset($_GET['anid'])) {
    require 'inc/connection.php';
    $query = "SELECT post_id,post_title, post_details,post_date,posts.user_id,user_fname FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE post_id = '".$_GET['anid']."' AND post_publish = 1";
    $anns = mysqli_query($connection,$query);
  } else {
    require 'inc/connection.php';
    $query = "SELECT post_id,post_title, post_details,post_date,posts.user_id,user_fname FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE post_publish = 1 ORDER BY post_date DESC LIMIT 6";
    $anns = mysqli_query($connection,$query);
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
        <div class="panel-body">
          <?php
            foreach($anns as $ann) {
              echo '<h3><b><a href="announcements.php?anid='.$ann['post_id'].'">'.$ann['post_title'].'</a></b></h3>';
              echo '<p>by <a href="profile.php?uid='.$ann['user_id'].'">'.$ann['user_fname'].'</a> on '.$ann['post_date'].'</p>';
              echo '<p>'.$ann['post_details'].'</p>';
            }
          ?>
        </div>
      </div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
