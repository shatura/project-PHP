<?php
session_start();

include_once ("classes/DB.php");
include_once ("classes/user.php");
include_once ("classes/comment.php");

define('HOST','localhost');
define('USER','ROOT');
define('PASSWORD', '');
define('DBNAME', 'guestbook');
define('CHARSET', 'UTF-8');
define('SALT', 'webDEVblog');


?>