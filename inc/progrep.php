<div class="row">
  <div class="col-lg-6">
    <div id="canvas-holder">
      <canvas id="program-rank" width="258" height="258"/>
    </div>
  </div>
  <div class="col-lg-6">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Program Name</th>
          <th>Registered Users</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $cnt = 1;
          foreach($top_progs as $prog) {
            echo '<tr><td>'.$cnt++.'</td><td>'.$prog['program_name'].'</a></td><td>'.$prog['reg_count'].'</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
var progrank_data = {
  labels: [<?php $cnt = 1; foreach($top_progs as $prog) echo '"'.$cnt++.'",'; ?>],
  datasets: [
    {
      fillColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      strokeColor : "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightFill: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      highlightStroke: "<?php echo '#'.dechex(mt_rand(0,16777214)) ?>",
      data: [<?php foreach($top_progs as $prog) echo $prog['reg_count'].','; ?>]
    }
  ]
}
</script>
