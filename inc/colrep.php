<div class="row">
  <div class="col-lg-6">
    <div id="canvas-holder">
      <canvas id="college-rank" width="258" height="258"/>
    </div>
  </div>
  <div class="col-lg-6">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Rank</th>
          <th>College</th>
          <th>Registered Users</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $cnt = 1;
          foreach($pop_coll as $coll) {
            echo '<tr><td>'.$cnt++.'</td><td>'.$coll['college_name'].'</td><td>'.$coll['reg_count'].'</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
var collpop_data = [
<?php
  foreach($pop_coll as $coll)
    echo '{ value: '.$coll['reg_count'].', color:"#'.dechex(mt_rand(0,16777214)).'", highlight: "#'.dechex(mt_rand(0,16777214)).'", label: "'.$coll['college_name'].'"},';
  echo'{value:0,color:"transparent", highlight:"transparent", label:""}';
?>
  ];
</script>
