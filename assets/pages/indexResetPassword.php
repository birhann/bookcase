<h2 class="ui teal image header">
  <img src="assets/images/logo.png" class="image">
  <div class="content">
    Reset Password
  </div>
</h2>
<form class="ui large form" id="ResetPasswordF" method="POST" action="index.php?Page=ResetPassword">
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui left icon input">
        <i class="address card icon"></i>
        <input type="email" name="rp_eMail" placeholder="E-Mail Address">
      </div>
    </div>
    <div class="ui fluid large teal submit button">Reset Password</div>
  </div>

  <div class="ui error message"></div>

</form>

<div class="ui message">
  Do you already have an account? <a href="index.php">Login</a>
</div>