<?php
$photo = $_GET['IMG'];
if (@$_GET['Tur'] == 'K') {
  $r_genislik = 400;
  $r_yukseklik = 600;
} else {
  $r_genislik = 450;
  $r_yukseklik = 450;
}
header("Content-type: image/jpeg");
list($gen, $yuk) = getimagesize($photo);

$enOran = $r_genislik / $gen;
$boyOran = $r_yukseklik / $yuk;

if ($enOran > $boyOran) {
  $yEn = floor($gen * $enOran);
  $yBoy = floor($yuk * $enOran);
} else {
  $yEn = floor($gen * $boyOran);
  $yBoy = floor($yuk * $boyOran);
}
$fEn = floor(0 - (($yEn - $r_genislik) / 2));
$fBoy = floor(0 - (($yBoy - $r_yukseklik) / 2));

$img_orig = imagecreatefromjpeg($photo);
$img_kes = imagecreatetruecolor($r_genislik, $r_yukseklik);
imagecopyresized($img_kes, $img_orig, $fEn, $fBoy, 0, 0, $yEn, $yBoy, $gen, $yuk);

imagejpeg($img_kes);

imagedestroy($img_kes);
imagedestroy($img_orig);
