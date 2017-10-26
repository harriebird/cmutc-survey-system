<header>
  <div class="animated fadeIn" id="header">
    <a href="index.php"><img class="img-responsive" src="img/header.png" alt="TC Header"></a>
  </div>
  <nav class="navbar navbar-inverse">
    <ul class="nav nav-pills pull-left">
      <li class="active">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">CMU TC</a>
        </div>
      </li>
      <li>
        <form class="form-inline navbar-form" role="form" method="get" action="search.php">
          <div class="form-group">
            <input type="search" class="form-control" id="search" name="query" placeholder="User Search" required>
          </div>
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
      </li>
    </ul>
    <ul class="nav nav-pills pull-right">
      <?php
        if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
          require 'inc/connection.php';
          $query = "SELECT user_fname FROM users WHERE user_id = '".$_SESSION['my_uid']."' LIMIT 1";
          $result = mysqli_query($connection,$query);
          $user = mysqli_fetch_array($result);
          echo '<li><a class="btn btn-info navbar-btn" href="home.php"><span class="glyphicon glyphicon-user"></span> '. $user['user_fname']. '</a></li>';
          echo '<li><a class="btn btn-danger navbar-btn" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
        }else {
          echo '<li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span> Welcome visitor</p></li>';
          echo '<li><a class="btn btn-success navbar-btn" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
        }
      ?>
    </ul>
  </nav>
</header>
