<?php
  session_start();
  require 'inc/connection.php';
  if(!empty($_GET) && isset($_GET['oid']) && is_numeric($_GET['oid'])) {
    if(!empty($_POST) && isset($_POST['btnComment'])) {
      $comment = $_POST['comment'];
      $offid = $_POST['offerid'];
      $usid = $_POST['userid'];
      $query = "UPDATE offer_students SET offstud_testimonial = '$comment', testi_posted = NOW() WHERE offer_id=".$offid." AND user_id=".$usid."";
      mysqli_query($connection,$query);
      if(mysqli_affected_rows($connection) > 0) {
        $message = "<h4>Testimonial was successfully posted.</h4>";
      }
      else
        $message = "<h4>Testimonial was not successfully posted.</h4>";
      $query="SELECT subject_offers.offer_id, subject_offers.offer_date, subjects.subject_desc, COUNT(offer_students.user_id) AS stud_count, subject_offers.user_id, CONCAT(users.user_fname,' ', users.user_lname) as tut_name FROM subject_offers INNER JOIN offer_students ON subject_offers.offer_id = offer_students.offer_id INNER JOIN subjects ON subject_offers.subject_id = subjects.subject_id INNER JOIN users ON subject_offers.user_id = users.user_id GROUP BY subject_offers.offer_id";
      $subject_offs= mysqli_query($connection,$query);
    }
    $query = "SELECT subject_offers.offer_id, subject_offers.subject_id, subjects.subject_code, subjects.subject_desc, subject_offers.user_id, CONCAT(users.user_fname,' ',users.user_lname) as tutor_name, subject_offers.offer_date, subject_offers.sem_id, semesters.sem_name FROM subject_offers INNER JOIN users ON subject_offers.user_id = users.user_id INNER JOIN subjects ON subject_offers.subject_id = subjects.subject_id INNER JOIN semesters ON subject_offers.sem_id = semesters.sem_id WHERE subject_offers.offer_id=".$_GET['oid']." GROUP BY subject_offers.offer_id";
    $offer_info = mysqli_fetch_array(mysqli_query($connection,$query));
    $query = "SELECT offstud_id FROM offer_students WHERE offer_id=".$_GET['oid']."";
    $stud_count = mysqli_num_rows(mysqli_query($connection,$query));
    $query = "SELECT offer_students.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS stud_name, programs.program_name, offer_students.enlist_date FROM subject_offers INNER JOIN offer_students ON subject_offers.offer_id = offer_students.offer_id INNER JOIN users ON offer_students.user_id = users.user_id INNER JOIN programs ON users.program_id = programs.program_id WHERE subject_offers.offer_id =".$_GET['oid']." ORDER BY stud_name";
    $stud_list = mysqli_query($connection,$query);
    $query = "SELECT users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS stud_name, offer_students.user_id, offer_students.offstud_testimonial, offer_students.testi_posted FROM offer_students INNER JOIN users ON offer_students.user_id = users.user_id WHERE offer_students.offer_id=".$_GET['oid']." AND offstud_testimonial!='' ORDER BY testi_posted DESC";
    $stud_testis = mysqli_query($connection,$query);
    if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
      $query = "SELECT offstud_id FROM offer_students WHERE offer_id=".$_GET['oid']." AND user_id=".$_SESSION['my_uid']." AND offstud_testimonial IS NULL";
      $testi_num = mysqli_num_rows(mysqli_query($connection,$query));
    }
  }
  else {
    $query="SELECT subject_offers.offer_id, subjects.subject_desc, subject_offers.user_id, CONCAT(users.user_fname,' ', users.user_lname) as tut_name, subject_offers.offer_date FROM subject_offers INNER JOIN subjects ON subject_offers.subject_id = subjects.subject_id INNER JOIN users ON subject_offers.user_id = users.user_id";
    $subject_offs= mysqli_query($connection,$query);
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
      <?php
      if(isset($_GET['oid']) && is_numeric($_GET['oid'])) {
        include 'inc/offerinfo.php';
        include 'inc/studlist.php';
        if(isset($testi_num) && $testi_num > 0)
          include 'inc/addtesti.php';
        if(mysqli_num_rows($stud_testis) > 0)
          include 'inc/testis.php';
      }
      else
        include 'inc/offlist.php';
      ?>
    </article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
