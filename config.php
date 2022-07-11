<?php
require_once 'function.php';
require_once 'header.php';

define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'cepegra_forum');

define('MODE', 'dev');

$connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connect -> connect_error):
  die('Connection failed' . $connect->connect_error);
  else :
    $connect->set_charset('utf8');
endif;
?>