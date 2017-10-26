<?php
	session_start();
	require 'inc/connection.php';
	$query = "SELECT post_id,post_title,post_details,post_date,posts.user_id,user_fname FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE post_publish = 1 ORDER BY post_id DESC LIMIT 3";
	$rec_ann = mysqli_query($connection, $query);
	$query = "SELECT users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS tutor_name, COUNT(offer_students.offstud_id) AS stud_count FROM users INNER JOIN subject_offers ON subject_offers.user_id = users.user_id INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id GROUP BY users.user_id ORDER BY stud_count DESC LIMIT 1";
  $top_tut = mysqli_query($connection,$query);
	$query = "SELECT users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS full_name FROM users WHERE users.user_verified = 1 ORDER BY users.date_reg DESC LIMIT 5";
	$rec_reg = mysqli_query($connection,$query);
	$query = "SELECT subject_offers.offer_id, subjects.subject_desc FROM subject_offers INNER JOIN subjects ON subjects.subject_id = subject_offers.subject_id ORDER BY subject_offers.offer_date DESC LIMIT 5";
	$rec_off = mysqli_query($connection,$query);
?>
<!DOCTYPE html>
<html>
<?php include 'inc/head.php'; ?>
<body>
	<div class="container">
		<?php include 'inc/header.php'; ?>
		<article>
			<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-primary wow fadeInLeft">
						<div class="panel-heading">
							<h3 class="panel-title">Announcements</h3>
						</div>
						<div class="panel-body">
							<?php
								if(mysqli_num_rows($rec_ann) < 1) {
									echo '<h3>There are no announcements posted.</h3>';
								} else {
									foreach($rec_ann as $post) {
										echo '<h3><b><a href="announcements.php?anid='.$post['post_id'].'">'.$post['post_title'].'</a></b></h3>';
										echo '<p>by <a href="profile.php?uid='.$post['user_id'].'">'.$post['user_fname'].'</a> on '.date_format(new DateTime($post['post_date']),'F d, Y h:i A').' </p>';
										echo '<p class="ann-sum">'.$post['post_details'].'</p>';
									}
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-success wow fadeInRight">
						<div class="panel-heading">
							<h3 class="panel-title">Quick Links</h3>
						</div>
						<div class="panel-body">
							<a class="btn btn-success btn-block" href="viewreps.php"><span class="glyphicon glyphicon-signal"></span> View Reports</a>
							<a class="btn btn-success btn-block" href="register.php"><span class="glyphicon glyphicon-user"></span> Register Account</a>
							<a class="btn btn-success btn-block" href="verify.php"><span class="glyphicon glyphicon-ok"></span> Verify Account</a>
						</div>
					</div>
					<div class="panel panel-success wow fadeInRight">
						<div class="panel-heading">
							<h3 class="panel-title">Recently Registered Users</h3>
						</div>
						<div class="panel-body">
							<?php
								foreach($rec_reg as $user) {
									echo '<a href="profile.php?uid='.$user['user_id'].'">'.$user['full_name'].'</a></br>';
								}
							?>
						</div>
					</div>
					<div class="panel panel-success wow fadeInRight">
						<div class="panel-heading">
							<h3 class="panel-title">Recently Offered Subjects</h3>
						</div>
						<div class="panel-body">
							<?php
								foreach($rec_off as $offer) {
									echo '<a href="offers.php?oid='.$offer['offer_id'].'">'.$offer['subject_desc'].'</a></br>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
