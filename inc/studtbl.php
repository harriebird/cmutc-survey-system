<div class="panel panel-success wow fadeInLeft">
  <div class="panel-heading">
    <h3 class="panel-title">Subjects Enrolled</h3>
  </div>
  <div class="panel-body">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Subject Code</th>
          <th>Descriptive Title</th>
          <th>Tutor Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require 'inc/connection.php';
          $query3 = "SELECT subjects.subject_code, subjects.subject_desc, users.user_id, CONCAT(users.user_fname,' ', users.user_lname) AS tut_name, subject_offers.offer_id, offer_students.offstud_id FROM offer_students INNER JOIN subject_offers ON subject_offers.offer_id = offer_students.offer_id INNER JOIN subjects ON subjects.subject_id = subject_offers.subject_id INNER JOIN users ON users.user_id = subject_offers.user_id WHERE offer_students.user_id =".$user_info['user_id']."";
          $subs_info = mysqli_query($connection,$query3);
          foreach($subs_info as $subject) {
            echo '<tr>';
            echo '<td>'.$subject['subject_code'].'</td><td><a href="offers.php?oid='.$subject['offer_id'].'">'.$subject['subject_desc'].'</a></td><td><a href="profile.php?uid='.$subject['user_id'].'">'.$subject['tut_name'].'</a></td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
