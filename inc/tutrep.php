<div class="row">
  <div class="col-lg-6">
    <div id="canvas-holder">
      <canvas id="tutor-rank" width="258" height="258"/>
    </div>
  </div>
  <div class="col-lg-6">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Tutor Name</th>
          <th>Students</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $cnt = 1;
          foreach($top_tuts as $tut) {
            echo '<tr><td>'.$cnt++.'</td><td><a href="profile.php?uid='.$tut['user_id'].'">'.$tut['tutor_name'].'</a></td><td>'.$tut['stud_count'].'</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
var tutrank_data = {
  labels: [<?php $cnt = 1; foreach($top_tuts as $tut) echo '"'.$cnt++.'",'; ?>],
  datasets: [
    {
      fillColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      strokeColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightFill: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightStroke: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      data: [<?php foreach($top_tuts as $tut) echo $tut['stud_count'].','; ?>]
    }
  ]
}
</script>
