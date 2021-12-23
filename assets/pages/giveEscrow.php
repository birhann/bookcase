<?php
if ($_POST) {
  $Error = array();
  if (empty($_POST['uyeID']) || empty($_POST['kitapID'])) {
    array_push($Error, "You left empty space.");
  }

  if (empty($Error)) {
    $Zaman = time();
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO emanetler(kul_ID, kit_ID, yetkili_ID, v_Tarih) VALUES('{$_POST['uyeID']}', '{$_POST['kitapID']}', '{$_User->getID()}', '{$Zaman}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      $_SUCCESS = True;
    } else {
      array_push($Error, 'An error occurred during registration. Please refresh the page and try again.');
    }
  }
}
?>
<h1 class="ui header">Give Escrow</h1>
<div class="ui divider"></div>
<?php if (!($_User->YetkiVarMi('addEmanet'))) { ?>
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
        Error!
      </div>
      <div class="ui list">
        <?php foreach ($Error as $msg) { ?>
          <div class="item"><?= $msg; ?></div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  <?php if ($_SUCCESS == True) {
    header("refresh:1;url=home.php?Page=GiveEscrow"); ?>
    <div class="ui success message">
      <i class="close icon"></i>
      <div class="header">
        Successfull !
      </div>
      <p>The escrow operation has been successfully completed.</p>
    </div>
  <?php } ?>
  <div class="ui grid">
    <div class="ten wide column">
      <form class="ui form" action="home.php?Page=GiveEscrow" method="POST" id="EmanetVer">
        <div class="field">
          <label>Member Name Surname / Phone</label>
          <input name="uyeID" class="prompt" type="hidden" id="uyeID">
          <div class="ui search" id="UyeAra">
            <input class="prompt" type="text" placeholder="Member Name Surname / Phone">
            <div class="results"></div>
          </div>
        </div>
        <div class="field">
          <label>Book Name / ISBN</label>
          <input name="kitapID" class="prompt" type="hidden" id="KitapID">
          <div class="ui search" id="KitapAra">
            <input class="prompt" type="text" placeholder="Book Name">
            <div class="results"></div>
          </div>
        </div>
        <button class="fluid ui positive button" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Give Escrow</button>
      </form>
    </div>
    <div class="six wide column">
      <img class="disabled medium bordered centered ui image" src="assets/images/NoBook.png">
    </div>
  </div>
<?php } ?>