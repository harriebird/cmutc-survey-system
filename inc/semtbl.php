<table class="table table-responsive table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Semester Name</th>
      <th>Date Added</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!isset($semesters)){
        require 'inc/connection.php';
    		$query = "SELECT * FROM semesters ORDER BY date_added DESC";
    		$semesters = mysqli_query($connection,$query);
      }
      foreach($semesters as $sem) {
          echo '<tr>';
          echo '<td>'.$sem['sem_id'].'</td><td>'.$sem['sem_name'].'</td><td>'.date_format(new DateTime($sem['date_added']),'F d, Y h:i A').'</td><td><a name="btnEditSem" href="managesems.php?action=editsem&sid='.$sem['sem_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a href="managesems.php?action=delete&sid='.$sem['sem_id'].'" onclick="if (! confirm(\'Are you sure to delete this semester?\')) { return false; }"><span class="glyphicon glyphicon-remove"></span></a></td>';
          echo '</tr>';
      }
    ?>
  </tbody>
</table>
