<div class="animated lightSpeedIn lblue-form">
  <h3>Verify your account.</h3>
  <h5>Please login your email account in order to obtain the verification code.</h5>
  <form role="form" class="form-default" method="get" action="verify.php">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="user@domain.com" required>
      </div>
      <div class="form-group">
        <label for="vcode">Verification Code</label>
        <input type="text" class="form-control" id="vcode" name="vcode" placeholder="12345678" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Verify</button>
      </div>
  </form>
</div>
