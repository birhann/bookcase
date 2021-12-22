<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
ob_start();

require_once 'assets/php/conf/siteConf.php';

$_PGV = (empty($_GET['Page'])) ? 'Home' : $_GET['Page'];

require_once 'assets/php/conf/router.php';
require_once 'assets/php/conf/dbConf.php';


require_once 'assets/php/functions/mainFuncts.php';

if (empty($_SESSION['LoggedIn'])) {
    header('Location: index.php');
}

require_once 'assets/php/sessionControl.php';

if (!($_User->_userInfo['adr_ID'] > 0) && $_GET['Page'] != 'AddAddress') {
    header('Location: home.php?Page=AddAddress');
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title><?= $_CONF['Site']['Title']; ?> <?= $_PAGE['Title']; ?></title>

    <link rel="stylesheet" type="text/css" href="assets/components/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/components/site.css">

    <link rel="stylesheet" type="text/css" href="assets/components/container.css">
    <link rel="stylesheet" type="text/css" href="assets/components/grid.css">
    <link rel="stylesheet" type="text/css" href="assets/components/header.css">
    <link rel="stylesheet" type="text/css" href="assets/components/image.css">
    <link rel="stylesheet" type="text/css" href="assets/components/menu.css">
    <link rel="stylesheet" type="text/css" href="assets/components/message.css">

    <link rel="stylesheet" type="text/css" href="assets/components/statistic.css">
    <link rel="stylesheet" type="text/css" href="assets/components/feed.css">
    <link rel="stylesheet" type="text/css" href="assets/components/popup.css">
    <link rel="stylesheet" type="text/css" href="assets/components/button.css">
    <link rel="stylesheet" type="text/css" href="assets/components/transition.css">
    <link rel="stylesheet" type="text/css" href="assets/components/card.css">
    <link rel="stylesheet" type="text/css" href="assets/components/dimmer.css">
    <link rel="stylesheet" type="text/css" href="assets/components/form.css">
    <link rel="stylesheet" type="text/css" href="assets/components/dropdown.css">
    <link rel="stylesheet" type="text/css" href="assets/components/search.css">
    <link rel="stylesheet" type="text/css" href="assets/components/label.css">
    <link rel="stylesheet" type="text/css" href="assets/components/table.css">

    <link rel="stylesheet" type="text/css" href="assets/components/divider.css">
    <link rel="stylesheet" type="text/css" href="assets/components/list.css">
    <link rel="stylesheet" type="text/css" href="assets/components/segment.css">
    <link rel="stylesheet" type="text/css" href="assets/components/dropdown.css">
    <link rel="stylesheet" type="text/css" href="assets/components/icon.css">

    <link rel="stylesheet" type="text/css" href="assets/css/index.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



    <script src="assets/components/transition.js"></script>
    <script src="assets/components/popup.js"></script>
    <script src="assets/components/form.js"></script>
    <script src="assets/components/dropdown.js"></script>
    <script src="assets/components/dimmer.js"></script>
    <script src="assets/components/api.js"></script>
    <script src="assets/components/search.js"></script>
    <script src="assets/js/homePage.js"></script>

</head>

<body>

    <?php require_once('assets/pages/partials/header.php'); ?>

    <div class="ui main container" id="_anaicerik">
        <?php
        switch ($_GET['Page']) {
            case 'AddAddress':
                require_once('assets/pages/addAddress.php');
                break;
            case 'AddBook':
                require_once('assets/pages/addBook.php');
                break;
            case 'AddAuthor':
                require_once('assets/pages/addAuthor.php');
                break;
            case 'AddType':
                require_once('assets/pages/addType.php');
                break;
            case 'AddPublisher':
                require_once('assets/pages/addPublisher.php');
                break;
            case 'KullaniciEkle':
                require_once('assets/sayfalar/KullaniciEkle.php');
                break;
            case 'GiveEscrow':
                require_once('assets/pages/giveEscrow.php');
                break;
            case 'ShowEscrow':
                require_once('assets/pages/showEscrow.php');
                break;
            default:
                require_once('assets/pages/homepage.php');
                break;
        }
        ?>
    </div>

    <?php require_once('assets/pages/partials/footer.php'); ?>

</body>

</html>