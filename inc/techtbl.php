<div class="panel panel-success wow fadeInRight">
  <div class="panel-heading">
    <h3 class="panel-title">Subjects Taught</h3>
  </div>
  <div class="panel-body">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Subject Code</th>
          <th>Descriptive Title</th>
          <th>Students</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require 'inc/connection.php';
          $query2 = "SELECT subject_offers.offer_id, subjects.subject_code, subjects.subject_desc, COUNT(offer_students.user_id) AS stud_count FROM subject_offers INNER JOIN offer_students ON offer_students.offer_id = subject_offers.offer_id INNER JOIN subjects ON subjects.subject_id = subject_offers.subject_id WHERE subject_offers.user_id = ".$user_info['user_id']." GROUP BY subject_offers.offer_id";
          $tutor_info = mysqli_query($connection,$query2);
          foreach($tutor_info as $subject) {
            echo '<tr>';
            echo '<td>'.$subject['subject_code'].'</td><td><a href="offers.php?oid='.$subject['offer_id'].'">'.$subject['subject_desc'].'</a></td><td>'.$subject['stud_count'].'</td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
