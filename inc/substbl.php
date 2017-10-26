<table class="table table-responsive table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Subject Code</th>
      <th>Descriptive Title</th>
      <th>Tutor Name</th>
      <th>Enroll</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!isset($offers)){
        require 'inc/connection.php';
        $query = "SELECT subject_offers.offer_id, subject_code, subject_desc, users.user_id, CONCAT(users.user_fname,' ',users.user_lname) AS tutor_name FROM subject_offers INNER JOIN users ON subject_offers.user_id=users.user_id INNER JOIN subjects ON subject_offers.subject_id=subjects.subject_id ORDER BY subject_desc";
        $offers = mysqli_query($connection,$query);
      }
      foreach($offers as $offer) {
        echo '<tr>';
        echo '<td>'.$offer['offer_id'].'</td><td>'.$offer['subject_code'].'</td><td>'.$offer['subject_desc'].'</td><td><a href="profile.php?uid='.$offer['user_id'].'">'.$offer['tutor_name'].'</a></td><td><a href="enrolsubs.php?action=enroll&oid='.$offer['offer_id'].'"><span class="glyphicon glyphicon-plus"></span></a></td>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>
