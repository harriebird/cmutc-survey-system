<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Subject Offers List</h3>
  </div>
  <div class="panel-body">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descriptive Title</th>
          <th>Tutor Name</th>
          <th>Date Offered</th>
          <th>Students</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($subject_offs as $suboff)
            $query = "SELECT offstud_id FROM offer_students WHERE offer_id=".$suboff['offer_id']."";
            $stud_count = mysqli_num_rows(mysqli_query($connection,$query));
            echo '<tr><td>'.$suboff['offer_id'].'</td><td><a href="offers.php?oid='.$suboff['offer_id'].'">'.$suboff['subject_desc'].'</a></td><td><a href="profile.php?uid='.$suboff['user_id'].'">'.$suboff['tut_name'].'</a></td><td>'.date_format(new DateTime($suboff['offer_date']),'F d, Y h:i A').'</td><td>'.$stud_count.'</a></tr>';
        ?>
      </tbody>
    </table>
  </div>
</div>
