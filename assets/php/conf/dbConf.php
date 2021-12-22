<?php
$_CONF['DB']['Host']    = 'localhost';
$_CONF['DB']['User'] = 'root';
$_CONF['DB']['Pass']    = '775477birhan';
$_CONF['DB']['Database']  = 'bookcase';

$GLOBALS['DBC'] = mysqli_connect($_CONF['DB']['Host'], $_CONF['DB']['User'], $_CONF['DB']['Pass'], $_CONF['DB']['Database']);

if (mysqli_connect_errno()) {
  printf("Database connection error: %s\n", mysqli_connect_error());
  exit();
}

mysqli_set_charset($GLOBALS['DBC'], "utf8");
