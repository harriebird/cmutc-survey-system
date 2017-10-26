<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Offered Subject Information</h3>
  </div>
  <div class="panel-body">
    <?php
      if(isset($offer_info) && !empty($offer_info)) {
        echo '<h4>Subject Name: '.$offer_info['subject_desc'].' ('.$offer_info['subject_code'].')</h4>';
        echo '<h4>Tutor Name: <a href="profile.php?uid='.$offer_info['user_id'] .'">'.$offer_info['tutor_name'].'</a></h4>';
        echo '<h4>Date Offered: ' .date_format(new DateTime($offer_info['offer_date']),'F d, Y h:i A').'<h4>';
        echo '<h4>Semester Offered: ' .$offer_info['sem_name'].'<h4>';
        echo '<h4>Enrolled Students: '.$stud_count.' '.($stud_count < 2 ?'Student':'Students').'<h4>';
      }
      else
        echo '<h3 class="text-center">No record found.</h3>';
    ?>
  </div>
</div>
