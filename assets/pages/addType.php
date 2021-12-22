<?php
if ($_POST) {
  $Error = array();
  if (empty($_POST['tur_Ismi'])) {
    array_push($Error, "You left empty space.");
  }

  $KontrolTur = mysqli_query($GLOBALS['DBC'], "SELECT * FROM turler WHERE ktur_Ad = '{$_POST['tur_Ismi']}'");
  if (mysqli_num_rows($KontrolTur) > 0) {
    array_push($Error, 'This type already exists in the system');
  }

  if (empty($Error)) {
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO turler(ktur_Ad) VALUES('{$_POST['tur_Ismi']}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      $Params = json_encode(array("TurID" => $LastID));
      $Zaman = time();
      if (mysqli_query($GLOBALS['DBC'], "INSERT INTO akis_log(akis_Tur, kul_ID, akis_Param, akis_Zaman) VALUES('3', '{$_User->getID()}', '{$Params}', '{$Zaman}')")) {
        $_SUCCESS = True;
      } else {
        array_push($Error, 'An error occurred during registration. Please refresh the page and try again.');
      }
    } else {
      array_push($Error, 'An error occurred during registration. Please refresh the page and try again.');
    }
  }
}
?>
<h1 class="ui header">Add Type</h1>
<div class="ui divider"></div>
<?php if (!($_User->YetkiVarMi('addTur'))) { ?>
  <div class="ui error message">
    <div class="header">
      You are not authorized for this action.
    </div>
    <ul class="list">
      <li>If you think there is an error, contact the system administrator.</li>
    </ul>
  </div>
<?php } else { ?>
  <?php if (!empty($Error)) { ?>
    <div class="ui negative message">
      <div class="header">
        Hata !
      </div>
      <div class="ui list">
        <?php foreach ($Error as $msg) { ?>
          <div class="item"><?= $msg; ?></div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  <?php if ($_SUCCESS == True) {
    header("refresh:1;url=home.php"); ?>
    <div class="ui success message">
      <i class="close icon"></i>
      <div class="header">
        Successfull!
      </div>
      <p>Adding book has been done successfully.</p>
    </div>
  <?php } ?>
  <div class="ui grid">
    <div class="sixteen wide column">
      <form class="ui form" action="home.php?Page=AddType" method="POST" id="TurEkle">
        <div class="field">
          <label>Type Name</label>
          <input type="text" name="tur_Ismi" placeholder="Type Name" value="<?= $_POST['tur_Ismi']; ?>">
        </div>
        <button class="fluid ui positive button" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Add Type</button>
      </form>
    </div>
    <div class="sixteen wide column">
      <div class="ui grid">
        <div class="one column row">
          <div class="column">
            <div class="ui celled horizontal list">
              <?php
              $SQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM turler");
              while ($TypeInfo = mysqli_fetch_assoc($SQL)) {
              ?>
                <div class="item"><?= $TypeInfo['ktur_Ad']; ?></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>