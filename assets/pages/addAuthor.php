<?php
if ($_POST) {
  $Error = array();
  if (!empty($_POST['yazar_Ad']) || !empty($_POST['yazar_Soyad']) || !empty($_POST['yazar_DTarih']) || !empty($_POST['yazar_DYeri'])) {
    if (!empty($_FILES['yazar_Foto']['tmp_name'])) {
      $imagePath = "assets/images/authorPhoto/";
      $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'GIF', 'JPEG', 'JPG', 'PNG');
      $temp = explode('.', $_FILES['yazar_Foto']['name']);
      $extension = end($temp);
      if (in_array($extension, $allowedExts)) {
        if ($_FILES['yazar_Foto']['error'] > 0) {
          array_push($Error, 'Photo Upload Error : ' . $_FILES['yazar_Foto']['error']);
        } else {
          $filename = $_FILES['yazar_Foto']['tmp_name'];
          list($width, $height) = getimagesize($filename);
          if ($width >= 200 && $height >= 200) {
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($filename, $imagePath . $newfilename);
          } else {
            array_push($Error, 'The photo must be at least 200x200 in size.');
          }
        }
      } else {
        array_push($Error, 'Files other than GIF, JPEG, JPG and PNG formats are not accepted.');
      }
    }
  } else {
    array_push($Error, 'You left empty space.');
  }

  if (empty($Error)) {
    $aboutAuthor = mysqli_real_escape_string($GLOBALS['DBC'], $_POST['yazar_Hakkinda']);
    if (mysqli_query($GLOBALS['DBC'], "INSERT INTO yazarlar(yaz_Ad, yaz_Soyad, yaz_DTarih, " . (($_POST['yazar_Hakkinda']) ? "yaz_Hakkinda, " : '') . (($newfilename) ? "yaz_Foto, " : '') . " yaz_DYeri) VALUES('{$_POST['yazar_Ad']}','{$_POST['yazar_Soyad']}','{$_POST['yazar_DTarih']}'," . (($_POST['yazar_Hakkinda']) ? "'" . $aboutAuthor . "'," : '') . (($newfilename) ? "'" . $newfilename . "'," : '') . "'{$_POST['yazar_DYeri']}')")) {
      $LastID = mysqli_insert_id($GLOBALS['DBC']);
      $Params = json_encode(array("YazarID" => $LastID));
      $Time = time();
      if (mysqli_query($GLOBALS['DBC'], "INSERT INTO akis_log(akis_Tur, kul_ID, akis_Param, akis_Zaman) VALUES('2', '{$_User->getID()}', '{$Params}', '{$Time}')")) {
        $_SUCCESS = True;
      } else {
        mysqli_query($GLOBALS['DBC'], "DELETE FROM yazarlar WHERE yaz_ID = '{$LastID}'");
        unlink('assets/images/authorPhoto/' . $newfilename);
        array_push($Error, 'An error occurred during registration. Please refresh the page and try again.');
      }
    } else {
      array_push($Error, 'An error occurred during registration. Please refresh the page and try again.');
      unlink('assets/images/authorPhoto/' . $newfilename);
    }
  }
}
?>
<h1 class="ui header">Add Author</h1>
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
        Successfull !
      </div>
      <p>Adding an author has been successfully completed.</p>
    </div>
  <?php } ?>
  <div class="ui grid">
    <div class="ten wide column">
      <form class="ui form" action="home.php?Page=AddAuthor" method="POST" id="YazarEkle" enctype="multipart/form-data">
        <div class="field">
          <label>Author Name and Surname</label>
          <div class="two fields">
            <div class="field">
              <input type="text" name="yazar_Ad" placeholder="Name">
            </div>
            <div class="field">
              <input type="text" name="yazar_Soyad" placeholder="Surname">
            </div>
          </div>
        </div>
        <div class="field">
          <label>Birthday</label>
          <input type="text" name="yazar_DTarih" placeholder="Birthday">
        </div>
        <div class="field">
          <label>Place of birth</label>
          <input type="text" name="yazar_DYeri" placeholder="Place of birth">
        </div>
        <div class="field">
          <label>About Author</label>
          <textarea name="yazar_Hakkinda" placeholder="About Author" rows="5"></textarea>
        </div>
        <div class="field">
          <label>Author Photo</label>
          <input type="file" name="yazar_Foto" placeholder="Author Photo" id="FotografYukle">
        </div>
        <button class="fluid ui positive button" type="submit" <?= ($_SUCCESS) ? 'disabled' : ''; ?>>Add Author</button>
      </form>
    </div>
    <div class="six wide column">
      <img class="disabled medium bordered centered ui image" src="assets/images/NoBook.png" id="FotografGoster">
    </div>
  </div>
<?php } ?>