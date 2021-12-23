<?php

require_once '../../conf/dbConf.php';
header('Content-Type: application/json');
error_reporting(0);
$conn = $GLOBALS['DBC'];

if ($_POST['mode'] === 'add') {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birthday = $_POST['birthday'];
    $place = $_POST['place'];
    $about = $_POST['about'];
    // $photo = $_POST['photo'];

    mysqli_query($conn, "INSERT INTO yazarlar (yaz_Ad, yaz_Soyad, yaz_DTarih, yaz_DYeri, yaz_Hakkinda)
     VALUES ('$name','$surname','$birthday','$place','$about')");

    echo json_encode(true);
}

if ($_POST['mode'] === 'edit') {

    $result = mysqli_query($conn, "SELECT * FROM yazarlar WHERE yaz_ID='" . $_POST['id'] . "'");
    $row = mysqli_fetch_array($result);

    echo json_encode($row);
}

if ($_POST['mode'] === 'update') {
    mysqli_query($conn, "UPDATE yazarlar set
    yaz_Ad='" . $_POST['name'] . "',
    yaz_Soyad='" . $_POST['surname'] . "',
    yaz_DTarih='" . $_POST['birthday'] . "',
    yaz_DYeri='" . $_POST['place'] . "',
    yaz_Hakkinda='" . $_POST['about'] . "'
    WHERE yaz_ID='" . $_POST['id'] . "'");
    echo json_encode(true);
}

// yaz_Foto='" . $_POST['photo'] . "'
if ($_POST['mode'] === 'delete') {

    mysqli_query($conn, "DELETE FROM yazarlar WHERE yaz_ID='" . $_POST["id"] . "'");
    echo json_encode(true);
}
