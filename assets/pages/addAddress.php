<?php
if ($_POST) {
  if ($_POST['adrk_Il']) {
    $Il = $_POST['adrk_Il'];
    $provienceInfo = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM il WHERE ilID = '{$_POST['adrk_Il']}'"));
  }
  if ($_POST['adrk_Ilce']) {
    $districtInfo = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM ilce WHERE ilceID = '{$_POST['adrk_Ilce']}'"));
  }
  $Error = array();
  if (empty($_POST['adrk_Ismi']) || empty($_POST['adrk_Il']) || empty($_POST['adrk_Ilce']) || empty($_POST['adrk_PKodu']) || empty($_POST['adrk_Adres'])) {
    array_push($Error, "You left empty space.");
  }

  if (empty($Error)) {
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO adresler(adr_Ismi, ilID, ilceID, adr_PKodu, adr_Adres, kul_ID) VALUES('{$_POST['adrk_Ismi']}', '{$_POST['adrk_Il']}', '{$_POST['adrk_Ilce']}', '{$_POST['adrk_PKodu']}', '{$_POST['adrk_Adres']}', '{$_User->getID()}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      if (mysqli_query($GLOBALS['DBC'], "UPDATE kullanicilar SET adr_ID = '{$LastID}' WHERE id = '{$_User->getID()}'")) {
        $_SUCCESS = True;
      } else {
        array_push($Error, 'An error occurred during registration. Please refresh the page and try again. {HK:02}');
        mysqli_query($GLOBALS['DBC'], "DELETE FROM adresler WHERE adr_ID = '{$LastID}'");
      }
    } else {
      array_push($Error, 'An error occurred during registration. Please refresh the page and try again. {HK:01}');
    }
  }
}
?>
<div class="ui segment">
  <h2 class="ui left floated header">Add New Address</h2>
  <div class="ui clearing divider"></div>
  <?php if (!empty($Error)) { ?>
    <div class="ui negative message">
      <i class="close icon"></i>
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
        Successfull !
      </div>
      <p>The address has been successfully registered.</p>
    </div>
  <?php } ?>
  <form class="ui form" method="POST" id="AdresKayit">
    <div class="field">
      <label>Address Name</label>
      <input type="text" name="adrk_Ismi" placeholder="Address Name" value="<?= $_POST['adrk_Ismi']; ?>">
    </div>
    <div class="field">
      <label>Provience</label>
      <div class="ui search selection dropdown">
        <input type="hidden" name="adrk_Il" value="<?= $provienceInfo['ilID']; ?>">
        <i class="dropdown icon"></i>
        <div class="<?= ($provienceInfo) ? '' : 'default'; ?> text"> <?= ($provienceInfo) ? $provienceInfo['ilAd'] : 'Select Province'; ?></div>
        <div class="menu">
          <?php
          $ilSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM il");
          while ($ilBilgi = mysqli_fetch_assoc($ilSQL)) {
          ?>
            <div class="item" data-value="<?= $ilBilgi['ilID']; ?>" data-text="<?= $ilBilgi['ilAd']; ?>"><?= $ilBilgi['ilAd']; ?></div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="field">
      <label>District</label>
      <div class="ui search selection dropdown" id="Ilceler">
        <input type="hidden" name="adrk_Ilce" value="<?= $districtInfo['ilceID']; ?>">
        <i class="dropdown icon"></i>
        <div class="<?= ($districtInfo) ? '' : 'default'; ?> text"> <?= ($districtInfo) ? $districtInfo['ilceAd'] : 'Select Districs'; ?></div>
        <div class="menu">
          <?php
          if ($provienceInfo) {
            $ilSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM ilce WHERE ilID = {$provienceInfo['ilID']}");
            while ($ilBilgi = mysqli_fetch_assoc($ilSQL)) {
          ?>
              <div class="item" data-value="<?= $ilBilgi['ilceID']; ?>" data-text="<?= $ilBilgi['ilceAd']; ?>"><?= $ilBilgi['ilceAd']; ?></div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <div class="field">
      <label>Post code</label>
      <input type="number" name="adrk_PKodu" placeholder="Post code" value="<?= $_POST['adrk_PKodu']; ?>">
    </div>
    <div class="field">
      <label>Address</label>
      <textarea name="adrk_Adres" placeholder="Address"><?= $_POST['adrk_Adres']; ?></textarea>
    </div>
    <button class="ui button positive fluid" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Add Address or Choose</button>
  </form>
</div>