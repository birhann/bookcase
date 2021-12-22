<?php
if ($_POST) {
  if ($_POST['kitap_Tur']) {
    $kturBilgiler = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM turler WHERE ktur_ID = '{$_POST['kitap_Tur']}'"));
  }
  if ($_POST['kitap_Yayinevi']) {
    $yevBilgiler = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM yayinevleri WHERE yev_ID = '{$_POST['kitap_Yayinevi']}'"));
  }
  if ($_POST['kitap_Yazar']) {
    $yazBilgiler = mysqli_fetch_assoc(mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar WHERE yaz_ID = '{$_POST['kitap_Yazar']}'"));
  }

  $Hata = array();

  if (!empty($_POST['kitap_ISBN']) || !empty($_POST['kitap_Ad']) || !empty($_POST['kitap_Yazar']) || !empty($_POST['kitap_Yayinevi']) || !empty($_POST['kitap_Tur']) || !empty($_POST['kitap_SayfaSayisi']) || !empty($_POST['kitap_YTarih'])) {
    if (!empty($_FILES['kitap_Foto']['tmp_name'])) {
      $imagePath = "assets/images/bookCover/";
      $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'GIF', 'JPEG', 'JPG', 'PNG');
      $temp = explode('.', $_FILES['kitap_Foto']['name']);
      $extension = end($temp);
      if (in_array($extension, $allowedExts)) {
        if ($_FILES['kitap_Foto']['error'] > 0) {
          array_push($Hata, 'Photo Upload Error : ' . $_FILES['kitap_Foto']['error']);
        } else {
          $filename = $_FILES['kitap_Foto']['tmp_name'];
          list($width, $height) = getimagesize($filename);
          if ($width >= 200 && $height >= 200) {
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($filename, $imagePath . $newfilename);
          } else {
            array_push($Hata, 'The photo must be at least 200x200 in size.');
          }
        }
      } else {
        array_push($Hata, 'Files other than GIF, JPEG, JPG and PNG formats are not accepted.');
      }
    }
  } else {
    array_push($Hata, 'You left empty space.');
  }

  $KontrolISBN = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar WHERE kit_ISBN = '{$_POST['kitap_ISBN']}'");
  if (mysqli_num_rows($KontrolISBN) > 0) {
    array_push($Hata, 'This book has already been added. [ISBN]');
  }

  if (empty($Hata)) {
    $KitapTanitim = mysqli_real_escape_string($GLOBALS['DBC'], $_POST['kitap_Tanitim']);
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO kitaplar(kit_ISBN, kit_Ad, kit_SSayisi, kit_YTarih, " . (($_POST['kitap_Tanitim']) ? "kit_Tanitim," : '') . (($newfilename) ? "kit_Foto," : '') . " yaz_ID, yev_ID, ktur_ID) VALUES('{$_POST['kitap_ISBN']}','{$_POST['kitap_Ad']}','{$_POST['kitap_SayfaSayisi']}','{$_POST['kitap_YTarih']}'," . (($_POST['kitap_Tanitim']) ? "'" . $KitapTanitim . "'," : '') . (($newfilename) ? "'" . $newfilename . "'," : '') . "'{$_POST['kitap_Yazar']}','{$_POST['kitap_Yayinevi']}','{$_POST['kitap_Tur']}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      $Params = json_encode(array("BookID" => $LastID));
      $Zaman = time();
      if (mysqli_query($GLOBALS['DBC'], "INSERT INTO akis_log(akis_Tur, kul_ID, akis_Param, akis_Zaman) VALUES('1', '{$_User->getID()}', '{$Params}', '{$Zaman}')")) {
        $_SUCCESS = True;
      } else {
        mysqli_query($GLOBALS['DBC'], "DELETE FROM kitaplar WHERE kit_ID = '{$LastID}'");
        unlink('assets/images/bookCover/' . $newfilename);
        array_push($Hata, 'An error occurred during registration. Please refresh the page and try again. [HC:02]');
      }
    } else {
      array_push($Hata, 'An error occurred during registration. Please refresh the page and try again. [HC: 01]');
      unlink('assets/images/bookCover/' . $newfilename);
    }
  }
  // print_r($_POST);
  // print_r($_FILES);
  // print_r(nl2br($_POST['kitapTanitim']));
}
?>
<h1 class="ui header">Kitap Ekle</h1>
<div class="ui divider"></div>
<?php if (!($_User->YetkiVarMi('addKitap'))) { ?>
  <div class="ui error message">
    <div class="header">
      You are not authorized for this action.
    </div>
    <ul class="list">
      <li>If you think there is an error, contact the system administrator.</li>
    </ul>
  </div>
<?php } else { ?>
  <?php if (!empty($Hata)) { ?>
    <div class="ui negative message">
      <i class="close icon"></i>
      <div class="header">
        Error !
      </div>
      <div class="ui list">
        <?php foreach ($Hata as $msg) { ?>
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
        Successful !
      </div>
      <p>Adding book has been done successfully.</p>
    </div>
  <?php } ?>
  <div class="ui grid">
    <div class="ten wide column">
      <form class="ui form" action="home.php?Page=AddBook" method="POST" id="KitapEkle" enctype="multipart/form-data">
        <div class="field">
          <label>Book ISBN</label>
          <input type="number" name="kitap_ISBN" placeholder="ISBN" value="<?= $_POST['kitap_ISBN']; ?>">
        </div>
        <div class="field">
          <label>Book Name</label>
          <input type="text" name="kitap_Ad" placeholder="Book Name" value="<?= $_POST['kitap_Ad']; ?>">
        </div>
        <div class="field">
          <label>Author</label>
          <div class="ui search selection dropdown">
            <input type="hidden" name="kitap_Yazar" value="<?= $yazBilgiler['yaz_ID']; ?>">
            <i class="dropdown icon"></i>
            <div class="<?= ($yazBilgiler) ? '' : 'default'; ?> text"> <?= ($yazBilgiler) ? $yazBilgiler['yaz_Ad'] . " " . $yazBilgiler['yaz_Soyad'] : 'Choose Author'; ?></div>
            <div class="menu">
              <?php
              $yazSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar");
              while ($yazBilgi = mysqli_fetch_assoc($yazSQL)) {
              ?>
                <div class="item" data-value="<?= $yazBilgi['yaz_ID']; ?>" data-text="<?= $yazBilgi['yaz_Ad']; ?> <?= $yazBilgi['yaz_Soyad']; ?>"><?= $yazBilgi['yaz_Ad']; ?> <?= $yazBilgi['yaz_Soyad']; ?></div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Publisher</label>
          <div class="ui search selection dropdown">
            <input type="hidden" name="kitap_Yayinevi" value="<?= $yevBilgiler['yev_ID']; ?>">
            <i class="dropdown icon"></i>
            <div class="<?= ($yevBilgiler) ? '' : 'default'; ?> text"> <?= ($yevBilgiler) ? $yevBilgiler['yev_Ad'] : 'Choose Publisher'; ?></div>
            <div class="menu">
              <?php
              $yevSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yayinevleri");
              while ($yevBilgi = mysqli_fetch_assoc($yevSQL)) {
              ?>
                <div class="item" data-value="<?= $yevBilgi['yev_ID']; ?>" data-text="<?= $yevBilgi['yev_Ad']; ?>"><?= $yevBilgi['yev_Ad']; ?></div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Book Type</label>
          <div class="ui search selection dropdown">
            <input type="hidden" name="kitap_Tur" value="<?= $kturBilgiler['ktur_ID']; ?>">
            <i class="dropdown icon"></i>
            <div class="<?= ($kturBilgiler) ? '' : 'default'; ?> text"> <?= ($kturBilgiler) ? $kturBilgiler['ktur_Ad'] : 'Choose Book Type'; ?></div>
            <div class="menu">
              <?php
              $kturSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM turler");
              while ($kturBilgi = mysqli_fetch_assoc($kturSQL)) {
              ?>
                <div class="item" data-value="<?= $kturBilgi['ktur_ID']; ?>" data-text="<?= $kturBilgi['ktur_Ad']; ?>"><?= $kturBilgi['ktur_Ad']; ?></div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <div class="field">
          <label>Page Count</label>
          <input type="number" name="kitap_SayfaSayisi" placeholder="Page Count" value="<?= $_POST['kitap_SayfaSayisi']; ?>">
        </div>
        <div class="field">
          <label>Release Date</label>
          <input type="number" name="kitap_YTarih" placeholder="Release Date" value="<?= $_POST['kitap_YTarih']; ?>">
        </div>
        <div class="field">
          <label>Book Launches</label>
          <textarea name="kitap_Tanitim" placeholder="Book Launches" rows="5"><?= $_POST['kitap_Tanitim']; ?></textarea>
        </div>
        <div class="field">
          <label>Book Photo</label>
          <input type="file" name="kitap_Foto" placeholder="Book Photo" id="FotografYukle">
        </div>
        <button class="fluid ui positive button" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Add Book</button>
      </form>
    </div>
    <div class="six wide column">
      <img class="disabled medium bordered centered ui image" src="assets/images/NoBook.png" id="FotografGoster">
    </div>
  </div>
<?php } ?>