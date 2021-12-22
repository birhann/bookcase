<?php
require_once 'class/role.class.php';
require_once 'class/user.class.php';

$_User = new User($_SESSION['LoggedIn']);
