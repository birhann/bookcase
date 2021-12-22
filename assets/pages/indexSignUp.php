<?php
if ($_POST) {
  $Error = array();

  if (
    empty($_POST['i_Ad']) ||
    empty($_POST['i_Soyad']) ||
    empty($_POST['i_KullaniciAdi']) ||
    empty($_POST['i_EPosta']) ||
    empty($_POST['i_TelNo']) ||
    !isset($_POST['i_Cinsiyet']) ||
    empty($_POST['i_Parola']) ||
    empty($_POST['i_ParolaT']) ||
    empty($_POST['i_USozlesme']) ||
    empty($_POST['i_DGun']) ||
    empty($_POST['i_DAy']) ||
    empty($_POST['i_DYil'])
  ) {
    array_push($Error, 'Please fill in all fields..');
  }

  if (!is_numeric($_POST['i_TelNo']) && strlen($_POST['i_TelNo']) != 10) {
    array_push($Error, 'Phone number is incorrect.');
  }

  if (strlen($_POST['i_Parola']) < 6) {
    array_push($Error, 'Your password must be at least 6 characters.');
  }

  if ($_POST['i_Parola'] != $_POST['i_ParolaT']) {
    array_push($Error, 'Passwords do not match.');
  }

  if (!($_POST['i_DGun'] >= 1 && $_POST['i_DGun'] <= 31)) {
    array_push($Error, 'You entered the wrong day. (1-31)');
  }

  if (!($_POST['i_DAy'] >= 1 && $_POST['i_DAy'] <= 12)) {
    array_push($Error, 'You entered the wrong month. (1-12)');
  }

  if (!($_POST['i_DYil'] >= 1900 && $_POST['i_DYil'] <= 2100)) {
    array_push($Error, 'You entered the wrong year. (1900+)');
  }

  /* Database Controls */

  $KontrolKAD = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_kAd = '{$_POST['i_KullaniciAdi']}'");
  if (mysqli_num_rows($KontrolKAD) > 0) {
    array_push($Error, 'Username is being used...');
  }

  $KontrolEPosta = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_EPosta = '{$_POST['i_EPosta']}'");
  if (mysqli_num_rows($KontrolEPosta) > 0) {
    array_push($Error, 'E-mail address is being used...');
  }

  $KontrolTelefon = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_Telefon = '{$_POST['i_TelNo']}'");
  if (mysqli_num_rows($KontrolTelefon) > 0) {
    array_push($Error, 'Phone number is in use...');
  }

  if (empty($Error)) {
    $DTarih = $_POST['i_DYil'] . '-' . (($_POST['i_DAy'] > 9) ? $_POST['i_DAy'] : '0' . $_POST['i_DAy']) . '-' . (($_POST['i_DGun'] > 9) ? $_POST['i_DGun'] : '0' . $_POST['i_DGun']);
    $Parola = md5($_POST['i_Parola']);
    $KZaman = time();
    $Ad = ucwords_tr($_POST['i_Ad']);
    $Soyad = ucwords_tr($_POST['i_Soyad']);
    $sqlUseradd = mysqli_query($GLOBALS['DBC'], "INSERT INTO kullanicilar(kul_Ad, kul_Soyad, kul_DTarih, kul_Cinsiyet, kul_kAd, kul_EPosta, kul_Telefon, kul_KTarih, kul_Parola) VALUES('{$Ad}', '{$Soyad}', '{$DTarih}', '{$_POST['i_Cinsiyet']}', '{$_POST['i_KullaniciAdi']}', '{$_POST['i_EPosta']}', '{$_POST['i_TelNo']}', '{$KZaman}', '{$Parola}')");
    if ($sqlUseradd) {
      $idSQL = mysqli_query($GLOBALS['DBC'], "SELECT kul_ID FROM kullanicilar WHERE kul_kAd = '{$_POST['i_KullaniciAdi']}'");
      $kulIDvar = intval(mysqli_fetch_assoc($idSQL));
      $yetki = 2; //kutuphanesorumulusu
      $query = mysqli_query($GLOBALS['DBC'], "INSERT INTO kullanici_rol (kul_ID, rol_id) VALUES ('{$kulIDvar}', '{$yetki}')");
      $_SUCCESS = True;
    } else {
      array_push($Error, 'An error occurred during registration. Please try again later.');
    }
  }
}
?>
<h2 class="ui teal image header">
  <img src="assets/images/logo.png" class="image">
  <div class="content">
    Create Account
  </div>
</h2>
<?php if (!empty($Error)) { ?>
  <div class="ui negative message">
    <i class="close icon"></i>
    <div class="header">
      Error! !
    </div>
    <div class="ui list">
      <?php foreach ($Error as $msg) { ?>
        <div class="item"><?= $msg; ?></div>
      <?php } ?>
    </div>
  </div>
<?php } ?>
<?php if ($_SUCCESS == True) {
  header("refresh:1;url=index.php"); ?>
  <div class="ui success message">
    <i class="close icon"></i>
    <div class="header">
      Successful !
    </div>
    <p>Registration completed successfully.</p>
  </div>
<?php } ?>
<form class="ui large form" id="KaydolF" method="POST" action="index.php?Page=SignUp">
  <div class="ui stacked segment">
    <div class="two fields">
      <div class="field">
        <div class="ui left icon input">
          <i class="user icon"></i>
          <input type="text" name="i_Ad" placeholder="Name" value="<?= $_POST['i_Ad']; ?>">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="user icon"></i>
          <input type="text" name="i_Soyad" placeholder="Surname" value="<?= $_POST['i_Soyad']; ?>">
        </div>
      </div>
    </div>
    <div class="three fields">
      <div class="field">
        <div class="ui left icon input">
          <i class="birthday cake icon"></i>
          <input type="number" name="i_DGun" placeholder="Day (1-31)" value="<?= $_POST['i_DGun']; ?>">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="birthday cake icon"></i>
          <input type="number" name="i_DAy" placeholder="Month (1-12)" value="<?= $_POST['i_DAy']; ?>">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="birthday cake icon"></i>
          <input type="number" name="i_DYil" placeholder="Year (1900)" value="<?= $_POST['i_DYil']; ?>">
        </div>
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="user circle icon"></i>
        <input type="text" name="i_KullaniciAdi" placeholder="Username" value="<?= $_POST['i_KullaniciAdi']; ?>">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="envelope icon"></i>
        <input type="text" name="i_EPosta" placeholder="E-Mail" value="<?= $_POST['i_EPosta']; ?>">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="mobile alternate icon"></i>
        <input type="number" name="i_TelNo" placeholder="Phone Number" value="<?= $_POST['i_TelNo']; ?>">
      </div>
    </div>
    <div class="field">
      <div class="ui selection dropdown">
        <input type="hidden" name="i_Cinsiyet">
        <i class="dropdown icon"></i>
        <div class="default text"><i class="genderless icon"></i> Gender</div>
        <div class="menu">
          <div class="item" data-value="0" data-text="<i class='mars icon'></i> Male">
            <i class="male icon"></i>
            Male
          </div>
          <div class="item" data-value="1" data-text="<i class='venus icon'></i> Female">
            <i class="female icon"></i>
            Female
          </div>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <div class="ui left icon input">
          <i class="lock icon"></i>
          <input type="password" name="i_Parola" placeholder="Password">
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="lock icon"></i>
          <input type="password" name="i_ParolaT" placeholder="Password (Again)">
        </div>
      </div>
    </div>
    <div class="field">
      <div class="ui checkbox">
        <input type="checkbox" name="i_USozlesme" <?= ($_POST['i_USozlesme']) ? 'checked' : ''; ?>>
        <label>I have read and accept the terms of the <a onclick="$('.ui.modal').modal('show');" href="#"> Membership Agreement</a>.</label>
      </div>
    </div>
    <div class="ui fluid large teal submit button">Create Account</div>
  </div>

  <div class="ui error message"></div>

</form>

<div class="ui message">
  Do you have an account? <a href="index.php">Sign In</a>
</div>

<div class="ui modal">
  <div class="header">Membership Agreement</div>
  <div class="scrolling content">
    <ul>
      <li>Entrance to the library is provided by using the Library ID Cards through the turnstiles.</li>
      <li>Library membership is required to benefit from lending services.</li>
      <li>Membership and loan transactions are made with Library Identity Cards.</li>
      <li>Membership and lending transactions cannot be made on behalf or identity of another person.</li>
      <li>It is the user's responsibility to return the borrowed resources at the specified time and without damaging the resources.</li>
      <li>A daily late fee of <b><u>25 cents</u></b> is charged for each late resource.</li>
      <li>For lost, non-returned or damaged resources, the user is obliged to provide the same. If the same cannot be found in the market, an equivalent resource determined by the authorized librarian is provided.</li>
      <li>Users with overdue resources or penalties cannot benefit from lending services.</li>
      <li>Lending services are based on Library Automation System records.</li>
      <li>No smoking in the library building; Food and drink (except water) is not allowed in the Library.</li>
      <li>Mobile phones should be kept in silent mode or turned off in the library building.</li>
      <li>Users are responsible for their own belongings. Library Management cannot be held responsible for lost or stolen items.</li>
      <li>Users are obliged to comply with the warnings of the library staff.</li>
      <li>There is no loud talking and group work in the library building.</li>
      <li>Penal sanctions are imposed on users who damage library materials and property in any way.</li>
      <li>When there is a change in the user's contact information (Mobile phone, E-mail), he/she has to notify the library.</li>
      <li>Agrees to comply with the Law on Intellectual and Artistic Works No. 5846 and all copyright legislation regarding electronic and printed resources.</li>
      <li>Persons using the library agree to abide by the library rules.</li>
      <li>The library management reserves the right to change the terms of the contract.</li>
      <li>Your e-mail account and phone number specified in the membership form, library education/event etc. It can be used for informational purposes in announcements.</li>
      <li>The personal information of the users is not shared with anyone and is not used. Personal information is required for the library automation system. Only the number of borrowing resources can be shared as statistical information.</li>
    </ul>
    <h2>Statement of Obligation</h2>
    <p class="ui red label">I agree to abide by the terms of the contract stated above and to fulfill any criminal liability that may arise otherwise.</p>
  </div>
  <div class="actions">
    <div class="ui cancel button positive" id="KOAKABUL">I have read, understood and accept.</div>
  </div>
</div>