<?php
require_once '../../conf/dbConf.php';

header('Content-Type: application/json');
error_reporting(0);


// $data['draw'] = isset($_GET['draw']) ? intval($_GET['draw']) : 0;
// // Total data set length
// $resTotalLength = mysqli_query(
//     $GLOBALS['DBC'],
//     "SELECT COUNT('id') FROM yazarlar"
// );
// $recordsTotal = $resTotalLength[0][0];
// $data['recordsTotal'] = intval($recordsTotal);

$data['data'] = array();
$query = mysqli_query($GLOBALS['DBC'], "SELECT * FROM yazarlar");
if ((mysqli_num_rows($query) > 0)) {

    while ($row = $query->fetch_array()) {
        if (strlen($row['yaz_Foto']) > 0) {
            $img = '<img src="assets/php/viewPhoto.php?Tur=authorList&IMG=../images/authorPhoto/' . $row['yaz_Foto'] . '">';
        } else {
            $img = '<img src="assets/php/viewPhoto.php?Tur=authorList&IMG=../images/avatar/default.jpg">';
        }
        $data['data'][] = array(
            $row['yaz_Ad'],
            $row['yaz_Soyad'],
            $row['yaz_DTarih'],
            $row['yaz_DYeri'],
            substr($row['yaz_Hakkinda'], 0, 137) . "...",
            $img,
            date('jS M Y', strtotime($row['created_at'])),
            '<a href="javascript:void(0)" class="btn btn-primary btn-edit" data-id="' . $row['yaz_ID'] . '"> Edit </a> <a href="javascript:void(0)" class="btn btn-danger btn-delete ml-2" data-id="' . $row['yaz_ID'] . '"> Delete </a>'
        );
    }
}

$object = (object)$data;
echo json_encode($object);
