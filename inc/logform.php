<div class="panel panel-primary animated zoomIn">
  <div class="panel-heading">
    <h3 class="panel-title">User Login</h3>
  </div>
  <div class="panel-body text-center">
    <form class="form-inline" role="form" method="post" action="login.php">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="user@domain.com" required>
      </div>
      <div class="form-group">
        <label for="pword">Password</label>
        <input type="password" class="form-control" id="pword" name="pword" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary" name="btnLogin"><span class="glyphicon glyphicon-log-in"></span> Login</button>
    </form>
    <a href="verify.php">Verify your Account</a>
  </div>
</div>
