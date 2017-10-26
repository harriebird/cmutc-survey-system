<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Testimonials</h3>
  </div>
  <div class="panel-body">
    <table class="table table-responsive table-striped table-hover">
      <tbody>
        <?php
          foreach($stud_testis as $testi)
            echo '<tr><td><a href="profile.php?uid='.$testi['user_id'].'">'.$testi['stud_name'].'</a></br><p>'.date_format(new DateTime($testi['testi_posted']),'F d, Y h:i A').'</br>'.$testi['offstud_testimonial'].'</p></td></tr>';
        ?>
      </tbody>
    </table>
  </div>
</div>
