<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

require_once 'assets/php/conf/siteConf.php';

$_PGV = (empty($_GET['Page'])) ? 'LogIn' : $_GET['Page'];

require_once 'assets/php/conf/routes.php';
require_once 'assets/php/conf/dbConf.php';

require_once 'assets/php/functions/mainFuncts.php';

if (!empty($_SESSION['LoggedIn'])) {
    header('Location: homepage.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title><?= $_CONF['Site']['Title']; ?> <?= $_PAGE['Title']; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/components/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/components/site.css">
    <link rel="stylesheet" type="text/css" href="assets/components/container.css">
    <link rel="stylesheet" type="text/css" href="assets/components/grid.css">
    <link rel="stylesheet" type="text/css" href="assets/components/header.css">
    <link rel="stylesheet" type="text/css" href="assets/components/image.css">
    <link rel="stylesheet" type="text/css" href="assets/components/menu.css">
    <link rel="stylesheet" type="text/css" href="assets/components/divider.css">
    <link rel="stylesheet" type="text/css" href="assets/components/segment.css">
    <link rel="stylesheet" type="text/css" href="assets/components/form.css">
    <link rel="stylesheet" type="text/css" href="assets/components/dropdown.css">
    <link rel="stylesheet" type="text/css" href="assets/components/loader.css">
    <link rel="stylesheet" type="text/css" href="assets/components/transition.css">
    <link rel="stylesheet" type="text/css" href="assets/components/input.css">
    <link rel="stylesheet" type="text/css" href="assets/components/button.css">
    <link rel="stylesheet" type="text/css" href="assets/components/list.css">
    <link rel="stylesheet" type="text/css" href="assets/components/message.css">
    <link rel="stylesheet" type="text/css" href="assets/components/icon.css">
    <link rel="stylesheet" type="text/css" href="assets/components/checkbox.css">
    <link rel="stylesheet" type="text/css" href="assets/components/modal.css">
    <link rel="stylesheet" type="text/css" href="assets/components/dimmer.css">
    <link rel="stylesheet" type="text/css" href="assets/components/label.css">


    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/components/form.js"></script>
    <script src="assets/components/dropdown.js"></script>
    <script src="assets/components/modal.js"></script>
    <script src="assets/components/transition.js"></script>
    <script src="assets/components/dimmer.js"></script>
    <script src="assets/js/login.js"></script>

</head>

<body>
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <?php
            switch ($_GET['Page']) {
                case 'SignUp':
                    require_once 'assets/pages/indexSignUp.php';
                    break;
                case 'ResetPassword':
                    require_once 'assets/pages/indexResetPassword.php';
                    break;
                default:
                    require_once 'assets/pages/indexLogin.php';
                    break;
            }
            ?>
        </div>
    </div>
</body>

</html>