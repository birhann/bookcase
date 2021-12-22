<?php
if ($_POST) {
  $Error = array();
  if (empty($_POST['yev_Ismi'])) {
    array_push($Error, "You left empty space.");
  }

  $publisherName = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yayinevleri WHERE yev_Ad = '{$_POST['yev_Ismi']}'");
  if (mysqli_num_rows($publisherName) > 0) {
    array_push($Error, 'This type already exists in the system');
  }

  if (empty($Error)) {
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO yayinevleri(yev_Ad) VALUES('{$_POST['yev_Ismi']}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      $Params = json_encode(array("YayinevID" => $LastID));
      $Zaman = time();
      if (mysqli_query($GLOBALS['DBC'], "INSERT INTO akis_log(akis_Tur, kul_ID, akis_Param, akis_Zaman) VALUES('4', '{$_User->getID()}', '{$Params}', '{$Zaman}')")) {
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
<h1 class="ui header">Yayınevi Ekle</h1>
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
        Error !
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
        Successfully!
      </div>
      <p>Added book successfully.</p>
    </div>
  <?php } ?>
  <div class="ui grid">
    <div class="sixteen wide column">
      <form class="ui form" action="home.php?Page=AddPublisher" method="POST" id="YayineviEkle">
        <div class="field">
          <label>Yayınevi İsmi</label>
          <input type="text" name="yev_Ismi" placeholder="Yayınevi İsmi" value="<?= $_POST['yev_Ismi']; ?>">
        </div>
        <button class="fluid ui positive button" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Yayınevi Ekle</button>
      </form>
    </div>
    <div class="sixteen wide column">
      <div class="ui grid">
        <div class="one column row">
          <div class="column">
            <div class="ui celled horizontal list">
              <?php
              $SQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yayinevleri");
              while ($publisherInfo = mysqli_fetch_assoc($SQL)) {
              ?>
                <div class="item"><?= $publisherInfo['yev_Ad']; ?></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>