<?php
if ($_POST) {
  $Error = array();
  if (empty($_POST['i_kAd']) || empty($_POST['i_kParola'])) {
    array_push($Error, 'There are empty fields.');
  }
  $Parola = md5($_POST['i_kParola']);
  $SessionControl = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE (kul_kAd = '{$_POST['i_kAd']}' || kul_EPosta = '{$_POST['i_kAd']}' || kul_Telefon = '{$_POST['i_kAd']}') && kul_Parola = '{$Parola}'");
  if (!(mysqli_num_rows($SessionControl) > 0)) {
    array_push($Error, 'Username or password is incorrect.');
  }
  if (empty($Error)) {
    $_SUCCESS = TRUE;
    $KBilgi = mysqli_fetch_assoc($SessionControl);
    $_SESSION['LoggedIn'] = $KBilgi['id'];
  }
}
?>

<h2 class="ui teal image header">
  <img src="assets/images/logo.png" class="image">
  <div class="content">
    Login
  </div>
</h2>

<?php if (!empty($Error)) { ?>
  <div class="ui negative message">
    <div class="header">
      Error!
    </div>
    <div class="ui list">
      <?php foreach ($Error as $msg) { ?>
        <div class="item"><?= $msg; ?></div>
      <?php } ?>
    </div>
  </div>
<?php } ?>
<?php if ($_SUCCESS) {
  require_once 'assets/php/functions/sessionUserCount.php';
  header("refresh:1;url=home.php"); ?>
  <div class="ui success message">
    <div class="header">
      Successful !
    </div>
    <p>You`re good.. Successful!</p>
  </div>
<?php } ?>



<form class="ui large form" method="POST" action="index.php">
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui left icon input">
        <i class="user icon"></i>
        <input type="text" name="i_kAd" placeholder="Username / E-Mail / Phone">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="lock icon"></i>
        <input type="password" name="i_kParola" placeholder="Password">
      </div>
    </div>
    <div class="ui fluid large teal submit button">Login</div>
  </div>
  <div class="ui error message"></div>

</form>

<div class="ui message">
  <div class="ui animated fade button" tabindex="0" onclick="window.location.href='index.php?Page=SignUp'">
    <div class="visible content">Don't you have an account?</div>
    <div class="hidden content">
      Create Account
    </div>
  </div>
  <div class="ui animated fade button" tabindex="0" onclick="window.location.href='index.php?Page=ResetPassword'">
    <div class="visible content">Forgot password? </div>
    <div class="hidden content">
      Reset Password
    </div>
  </div>
</div>