<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Student List</h3>
  </div>
  <div class="panel-body">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Student Name</th>
          <th>Academic Program</th>
          <th>Date Enrolled</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($stud_list as $stud)
            echo '<tr><td>'.$stud['user_id'].'</td><td><a href="profile.php?uid='.$stud['user_id'].'">'.$stud['stud_name'].'</a></td><td>'.$stud['program_name'].'</td><td>'.date_format(new DateTime($stud['enlist_date']),'F d, Y h:i A').'</td></tr>';
        ?>
      </tbody>
    </table>
  </div>
</div>
