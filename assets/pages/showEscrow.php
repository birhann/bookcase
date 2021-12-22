<?php
if ($_GET['Process'] == "Undo" && $_User->YetkiVarMi('geriEmanet')) {
  $Error = array();
  $PRM = explode('|#|', base64_decode($_GET['ID']));
  if (count($PRM) == 3) {
    $KontrolOturum = mysqli_query($GLOBALS['DBC'], "SELECT * FROM emanetler WHERE emanet_ID = {$PRM[0]} && kul_ID = {$PRM[1]} && kit_ID = {$PRM[2]}");
    if (!(mysqli_num_rows($KontrolOturum) == 1)) {
      array_push($Error, 'Escrow can`t find.');
    }
  } else {
    array_push($Error, 'Error!');
  }

  if (empty($Error)) {
    $Zaman = time();
    if (mysqli_query($GLOBALS['DBC'], "UPDATE emanetler SET a_Tarih = {$Zaman} WHERE emanet_ID = {$PRM[0]} && kul_ID = {$PRM[1]} && kit_ID = {$PRM[2]}")) {
      $_SUCCESS = True;
      $_SUCMESSAGE = 'Escrow successfully recovered.';
    } else {
      array_push($Error, 'An error occurred during escrow rollback.');
    }
  }
}
?>
<h1 class="ui header">Emanetler</h1>
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
    header("refresh:1;url=home.php?Page=ShowEscrow"); ?>
    <div class="ui success message">
      <i class="close icon"></i>
      <div class="header">
        Successfull!
      </div>
      <p><?= $_SUCMESSAGE; ?></p>
    </div>
  <?php } ?>
  <table class="ui very basic celled table">
    <thead>
      <tr>
        <th>Escrow No</th>
        <th>Issuer</th>
        <th>Receiver</th>
        <th>Book</th>
        <th>Escrow Date</th>
        <th>Process</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $SQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM emanetler, kitaplar, kullanicilar WHERE emanetler.a_Tarih IS NULL && emanetler.kul_ID = kullanicilar.kul_ID && emanetler.kit_ID = kitaplar.kit_ID ORDER BY emanet_ID");
      while ($EscrowInfo = mysqli_fetch_assoc($SQL)) {
        $AuthorizedUser = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_ID = '{$EscrowInfo['yetkili_ID']}'"));
      ?>
        <tr>
          <td> # <?= $EscrowInfo['emanet_ID']; ?> </td>
          <td>
            <h4 class="ui image header">
              <img src="assets/images/avatar/default.jpg" class="ui mini rounded image">
              <div class="content">
                <?= $EscrowInfo['kul_Ad']; ?> <?= $EscrowInfo['kul_Soyad']; ?>
              </div>
            </h4>
          </td>
          <td>
            <h4 class="ui image header">
              <img src="assets/images/avatar/default.jpg" class="ui mini rounded image">
              <div class="content">
                <?= $AuthorizedUser['kul_Ad']; ?> <?= $AuthorizedUser['kul_Soyad']; ?>
              </div>
            </h4>
          </td>
          <td>
            <h4 class="ui image header">
              <img src="assets/php/viewPhoto.php?Tur=K&IMG=../images/bookCover/<?= $EscrowInfo['kit_Foto']; ?>" class="ui mini rounded image">
              <div class="content">
                <?= $EscrowInfo['kit_Ad']; ?> / <?= $EscrowInfo['kit_YTarih']; ?>
                <div class="sub header"><?= $EscrowInfo['kit_ISBN']; ?></div>
              </div>
            </h4>
          </td>
          <td>
            <h4 class="ui header">
              <div class="content">
                <?= date('d / m / Y h:i', $EscrowInfo['v_Tarih']); ?>
                <div class="sub header"><?= timeAgo($EscrowInfo['v_Tarih']); ?></div>
              </div>
            </h4>
          </td>
          <td>
            <div class="ui vertical animated button" tabindex="0" onclick="window.location.href='home.php?Page=ShowEscrow&Process=Undo&ID=<?= base64_encode($EscrowInfo['emanet_ID'] . '|#|' . $EscrowInfo['kul_ID'] . '|#|' . $EscrowInfo['kit_ID']); ?>'">
              <div class="hidden content">Undo</div>
              <div class="visible content">
                <i class="reply icon"></i>
              </div>
            </div>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>