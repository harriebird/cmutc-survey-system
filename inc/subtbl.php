<table class="table table-responsive table-striped table-hover">
  <thead>
    <tr>
      <th>Subject Code</th>
      <th>Descriptive Title</th>
      <th>Date Added</th>
      <th>Edit</th>
      <?php if($_SESSION['my_role'] == 3) echo '<th>Delete</th>'; ?>

    </tr>
  </thead>
  <tbody>
    <?php
      if(!isset($subjects)){
        require 'inc/connection.php';
    		$query = "SELECT * FROM subjects ORDER BY subject_code";
    		$subjects = mysqli_query($connection,$query);
      }
      if($_SESSION['my_role'] == 3) {
        foreach($subjects as $sub) {
          echo '<tr>';
          echo '<td>'.$sub['subject_code'].'</td><td>'.$sub['subject_desc'].'</td><td>'.date_format(new DateTime($sub['date_added']),'F d, Y h:i A').'</td><td><a name="btnEditSub" href="managesubs.php?action=editsub&sid='.$sub['subject_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a name="btnDelSub" href="managesubs.php?action=delete&sid='.$sub['subject_id'].'" onclick="if (! confirm(\'Are you sure to delete the subject?\')) { return false; }"><span class="glyphicon glyphicon-trash"></span></a></td>';
          echo '</tr>';
        }
      }
      else {
        foreach($subjects as $sub) {
          echo '<tr>';
          echo '<td>'.$sub['subject_code'].'</td><td>'.$sub['subject_desc'].'</td><td>'.date_format(new DateTime($sub['date_added']),'F d, Y h:i A').'</td><td><a name="btnEditSub" href="managesubs.php?action=editsub&sid='.$sub['subject_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
          echo '</tr>';
        }
      }
    ?>
  </tbody>
</table>
