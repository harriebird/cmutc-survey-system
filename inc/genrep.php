<div class="row">
  <div class="col-lg-6">
    <div id="canvas-holder">
      <canvas id="gender-population" width="258" height="258"/>
    </div>
  </div>
  <div class="col-lg-6">
    <table class="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>Gender</th>
          <th>Registered Users</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($pop_gen as $gen) {
            echo '<tr><td>'.($gen['user_gender']=='M'?'Male':'Female').'</td><td>'.$gen['reg_count'].'</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
var genpop_data = [
<?php
  foreach($pop_gen as $gen)
    echo '{ value: '.$gen['reg_count'].', color:"#'.dechex(mt_rand(0,16777214)).'", highlight: "#'.dechex(mt_rand(0,16777214)).'", label: "'.($gen['user_gender']=='M'?'Male':'Female').'"},';
  echo'{value:0,color:"transparent", highlight:"transparent", label:""}';
?>
  ];
</script>
