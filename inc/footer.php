<footer>
  <div class="panel panel-primary">
    <div class="panel-body text-center">
      <?php
        if(isset($connection))
          mysqli_close($connection);
        echo '<p><b>&copy; '.date("Y"), ' CMU Tutorial Club</b></br><a href="//www.cmu.edu.ph">Central Mindanao University</a></br>Musuan, Maramag, Bukidnon</p>';
      ?>
    </div>
  </div>
</footer>
<script type="javascript/text" src="./lib/bootstrap.js"></script>
