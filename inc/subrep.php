<div class="row">
  <div class="col-lg-6">
    <div id="canvas-holder">
      <canvas id="subject-rank" width="258" height="258"/>
    </div>
  </div>
  <div class="col-lg-6">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Subject Code</th>
          <th>Descriptive Title</th>
          <th>Students</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $cnt = 1;
          foreach($top_subs as $sub) {
            echo '<tr><td>'.$cnt++.'</td><td>'.$sub['subject_code'].'</td><td>'.$sub['subject_desc'].'</td><td>'.$sub['stud_count'].'</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
var subrank_data = {
  labels: [<?php foreach($top_subs as $sub) echo '"'.$sub['subject_code'].'",'; ?>],
  datasets: [
    {
      fillColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      strokeColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightFill: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightStroke: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      data: [<?php foreach($top_subs as $sub) echo $sub['stud_count'].','; ?>]
    }
  ]
}
</script>
