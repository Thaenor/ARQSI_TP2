<?php
session_start();
//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require 'database/connect.php';
/*require 'functions/general.php';  ***Sanitizes data(prevent SQL injection)****/
/*require 'functions/users.php'; ***previous user login deprecated and can be deleted****/

$errors = array();
$dal = new DAL();
?>
