<?php
require_once '../conf/dbConf.php';
switch ($_POST['Islem']) {
  case 'getIlce':

    $IlSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM ilce WHERE ilID = {$_POST['IlPlaka']}");
    if (mysqli_num_rows($IlSQL) > 0) {
      while ($IlBilgi = mysqli_fetch_assoc($IlSQL)) {
        echo '<div class="item" data-value="' . $IlBilgi['ilceID'] . '" data-text="' . $IlBilgi['ilceAd'] . '">' . $IlBilgi['ilceAd'] . '</div>';
      }
    }
    break;
}
