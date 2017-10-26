<table class="table table-responsive table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Subject Code</th>
      <th>Descriptive Title</th>
      <th>Tutor Name</th>
      <th>Delist</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $query = "SELECT offstud_id, offer_students.offer_id, users.user_id, subject_code, subject_desc , CONCAT(user_fname,' ',user_lname) as tutor_name FROM offer_students INNER JOIN subject_offers ON offer_students.offer_id=subject_offers.offer_id INNER JOIN users ON subject_offers.user_id = users.user_id INNER JOIN subjects ON subject_offers.subject_id = subjects.subject_id WHERE offer_students.user_id =".$_SESSION['my_uid']."";
      $offers = mysqli_query($connection,$query);
      foreach($offers as $offer) {
        echo '<tr>';
        echo '<td>'.$offer['offstud_id'].'</td><td>'.$offer['subject_code'].'</td><td><a href="offers.php?oid='.$offer['offer_id'].'">'.$offer['subject_desc'].'</a></td><td><a href="profile.php?uid='.$offer['user_id'].'">'.$offer['tutor_name'].'</a></td><td><a href="enrolsubs.php?action=delist&oid='.$offer['offstud_id'].'" onclick="if (! confirm(\'Are you sure to delist from this subject offer?\')) { return false; }"><span class="glyphicon glyphicon-remove"></span></a></td>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>
