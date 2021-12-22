<?php
require_once '../conf/dbConf.php';
$JSON = array();
$JSON['results'] = array();
switch ($_GET['Process']) {
  case 'User':
    $KisiSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kullanicilar WHERE kul_Telefon LIKE '%{$_GET['q']}%' || CONCAT(kul_Ad,' ', kul_Soyad) LIKE '%{$_GET['q']}%'");
    if ((mysqli_num_rows($KisiSQL) > 0)) {
      while ($KBilgi = mysqli_fetch_assoc($KisiSQL)) {
        array_push($JSON['results'], array(
          'id' => $KBilgi['kul_ID'],
          'title' => $KBilgi['kul_Ad'] . ' ' . $KBilgi['kul_Soyad'],
          'description' => $KBilgi['kul_Telefon']
        ));
      }
    }
    break;
  case 'Book':
    $KisiSQL = mysqli_query($GLOBALS['DBC'], "SELECT * FROM kitaplar, yazarlar WHERE (kitaplar.kit_ISBN LIKE '%{$_GET['q']}%' || kitaplar.kit_Ad LIKE '%{$_GET['q']}%') && kitaplar.yaz_ID = yazarlar.yaz_ID");
    if ((mysqli_num_rows($KisiSQL) > 0)) {
      while ($KBilgi = mysqli_fetch_assoc($KisiSQL)) {
        array_push($JSON['results'], array(
          'id' => $KBilgi['kit_ID'],
          'title' => $KBilgi['kit_Ad'],
          'image' => 'assets/php/viewPhoto.php?IMG=../images/bookCover/' . $KBilgi['kit_Foto'],
          'description' => $KBilgi['yaz_Ad'] . ' ' . $KBilgi['yaz_Soyad'] . "\n" . $KBilgi['kit_ISBN']
        ));
      }
    }
    break;
}

echo json_encode($JSON);
