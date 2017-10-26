<?php
  session_start();
  require 'inc/connection.php';
  if(!empty($_GET) && isset($_GET['semid']) && is_numeric($_GET['semid'])) {
    $query = "SELECT * FROM semesters WHERE sem_id =".$_GET['semid']."";
    $sel_sem = mysqli_fetch_array(mysqli_query($connection,$query));
    $query = "SELECT colleges.college_id, colleges.college_name, COUNT(users.user_id) AS reg_count FROM colleges INNER JOIN programs ON programs.college_id = colleges.college_id INNER JOIN users ON users.program_id = programs.program_id WHERE date_reg BETWEEN CAST('".$sel_sem['date_start']."' AS DATE) AND CAST('".$sel_sem['date_end']."' AS DATE) GROUP BY colleges.college_id ORDER BY reg_count DESC";
    $pop_coll = mysqli_query($connection,$query);
    $query = "SELECT programs.program_id, programs.program_name, COUNT(users.user_id) AS reg_count FROM programs INNER JOIN users ON programs.program_id = users.program_id WHERE date_reg BETWEEN CAST('".$sel_sem['date_start']."' AS DATE) AND CAST('".$sel_sem['date_end']."' AS DATE) GROUP BY programs.program_id, programs.program_name ORDER BY reg_count DESC LIMIT 10";
    $top_progs = mysqli_query($connection,$query);
    $query = "SELECT subjects.subject_id, subjects.subject_code, subjects.subject_desc, COUNT(offer_students.offstud_id) AS stud_count FROM subjects INNER JOIN subject_offers ON subject_offers.subject_id = subjects.subject_id INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id  WHERE subject_offers.sem_id = ".$_GET['semid']." GROUP BY subjects.subject_id ORDER BY stud_count DESC LIMIT 10";
    $top_subs = mysqli_query($connection,$query);
    $query = "SELECT users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS tutor_name, COUNT(offer_students.offstud_id) AS stud_count FROM users INNER JOIN subject_offers ON subject_offers.user_id = users.user_id INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id  WHERE subject_offers.sem_id = ".$_GET['semid']." GROUP BY users.user_id ORDER BY stud_count DESC LIMIT 10";
    $top_tuts = mysqli_query($connection,$query);
    $query = "SELECT users.user_gender, COUNT(users.user_id) AS reg_count FROM users  WHERE date_reg BETWEEN CAST('".$sel_sem['date_start']."' AS DATE) AND CAST('".$sel_sem['date_end']."' AS DATE) GROUP BY users.user_gender ORDER BY reg_count DESC";
    $pop_gen = mysqli_query($connection,$query);
  }
  else {
    $query = "SELECT colleges.college_id, colleges.college_name, COUNT(users.user_id) AS reg_count FROM colleges INNER JOIN programs ON programs.college_id = colleges.college_id INNER JOIN users ON users.program_id = programs.program_id GROUP BY colleges.college_id ORDER BY reg_count DESC";
    $pop_coll = mysqli_query($connection,$query);
    $query = "SELECT programs.program_id, programs.program_name, COUNT(users.user_id) AS reg_count FROM programs INNER JOIN users ON programs.program_id = users.program_id GROUP BY programs.program_id, programs.program_name ORDER BY reg_count DESC LIMIT 10";
    $top_progs = mysqli_query($connection,$query);
    $query = "SELECT subjects.subject_id, subjects.subject_code, subjects.subject_desc, COUNT(offer_students.offstud_id) AS stud_count FROM subjects INNER JOIN subject_offers ON subject_offers.subject_id = subjects.subject_id INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id GROUP BY subjects.subject_id ORDER BY stud_count DESC LIMIT 10";
    $top_subs = mysqli_query($connection,$query);
    $query = "SELECT users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS tutor_name, COUNT(offer_students.offstud_id) AS stud_count FROM users INNER JOIN subject_offers ON subject_offers.user_id = users.user_id INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id GROUP BY users.user_id ORDER BY stud_count DESC LIMIT 10";
    $top_tuts = mysqli_query($connection,$query);
    $query = "SELECT users.user_gender, COUNT(users.user_id) AS reg_count FROM users GROUP BY users.user_gender ORDER BY reg_count DESC";
    $pop_gen = mysqli_query($connection,$query);
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
          <h3 class="panel-title">Select a Semester</h3>
        </div>
        <div class="panel-body text-center">
          <form role="form" class="form-inline" method="get" action="viewreps.php">
            <select name="semid" class="form-control" required>
              <option value="">Select a Semester here</option>
              <?php
                $query = "SELECT sem_id, sem_name FROM semesters";
                $semesters = mysqli_query($connection,$query);
                foreach($semesters as $sem) {
                  echo "<option value='". $sem['sem_id'] ."'>". $sem['sem_name']."</option>";
                }
              ?>
            </select>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Apply</button>
          </form>
        </div>
      </div>
      <h3>Survey Reports</h3>
      <div class="panel panel-primary wow fadeInRight">
        <div class="panel-heading">
          <h3 class="panel-title">Registered users from different Colleges <?php if(isset($sel_sem)) echo 'on '.$sel_sem['sem_name']?></h3>
        </div>
        <div class="panel-body">
          <?php
            if(mysqli_num_rows($pop_coll) > 0)
              include 'inc/colrep.php';
            else
              echo '<h4>There are no users registered at this semester.</h4>';
          ?>
        </div>
      </div>

      <div class="panel panel-primary wow fadeInLeft">
        <div class="panel-heading">
          <h3 class="panel-title">Registered users by Gender <?php if(isset($sel_sem)) echo 'on '.$sel_sem['sem_name']?></h3>
        </div>
        <div class="panel-body">
          <?php
            if(mysqli_num_rows($pop_gen) > 0)
              include 'inc/genrep.php';
            else
              echo '<h4>There are no users registered at this semester.</h4>';
          ?>
        </div>
      </div>

      <div class="panel panel-primary wow fadeInRight">
        <div class="panel-heading">
          <h3 class="panel-title">Top <?php echo (mysqli_num_rows($top_progs) > 1? 'Programs':'Program') ?> with Registered Users <?php if(isset($sel_sem)) echo 'on '.$sel_sem['sem_name']?></h3>
        </div>
        <div class="panel-body">
          <?php
            if(mysqli_num_rows($top_progs) > 0)
              include 'inc/progrep.php';
            else
              echo '<h4>There are no top programs at this semester.</h4>';
          ?>
        </div>
      </div>

      <div class="panel panel-primary wow fadeInLeft">
        <div class="panel-heading">
          <h3 class="panel-title">Top <?php echo (mysqli_num_rows($top_subs) > 1? 'Subjects':'Subject') ?> <?php if(isset($sel_sem)) echo 'on '.$sel_sem['sem_name']?></h3>
        </div>
        <div class="panel-body">
          <?php
            if(mysqli_num_rows($top_subs) > 0)
              include 'inc/subrep.php';
            else
              echo '<h4>There are no top subjects at this semester.</h4>';
          ?>
        </div>
      </div>

      <div class="panel panel-primary wow fadeInRight">
        <div class="panel-heading">
          <h3 class="panel-title">Top <?php echo (mysqli_num_rows($top_tuts) > 1? 'Tutors':'Tutor') ?> <?php if(isset($sel_sem)) echo 'on '.$sel_sem['sem_name']?></h3>
        </div>
        <div class="panel-body">
          <?php
            if(mysqli_num_rows($top_tuts) > 0)
              include 'inc/tutrep.php';
            else
              echo '<h4>There are no top tutors at this semester.</h4>';
          ?>
        </div>
      </div>
  	  <script>
      window.onload = function(){
        var col_rank = document.getElementById("college-rank").getContext("2d");
        window.colRank = new Chart(col_rank).Pie(collpop_data);
        var gen_pop = document.getElementById("gender-population").getContext("2d");
        window.colRank = new Chart(gen_pop).Pie(genpop_data);
        var prog_rank = document.getElementById("program-rank").getContext("2d");
        window.subRank = new Chart(prog_rank).Bar(progrank_data);
        var sub_rank = document.getElementById("subject-rank").getContext("2d");
        window.subRank = new Chart(sub_rank).Bar(subrank_data);
        var tut_rank = document.getElementById("tutor-rank").getContext("2d");
        window.tutRank = new Chart(tut_rank).Bar(tutrank_data);
      };
  	  </script>
		</article>
		<?php include 'inc/footer.php'; ?>
	</div>
</body>
</html>
