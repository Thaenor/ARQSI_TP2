<?php
/**
 * Created by PhpStorm.
 * User: thaenor
 * Date: 06/12/14
 * Time: 19:01
 */
 error_reporting(0);
 //error_reporting(E_ALL);
 //ini_set('display_errors', 'on');
require_once 'DAL.php';

if(isset($_REQUEST['username'])){
    $username = $_GET['username'];
}
else
    echo 'ERROR: username not set';

if(isset($_REQUEST['password'])){
    $password = $_GET['password'];
}
else
    echo 'ERROR: password not set';

$dal = new DAL();
//prevents SQL injection
$username = $dal->sanitize($username);
$password = $dal->sanitize($password);

$reply = $dal->validLogin($username, $password);

//reply is 1 for admin, 2 for client and 0 for an error;
switch ($reply) {
  case 0:
  echo "error";
  break;
  case 1:
  echo "a";
  break;
  case 2:
  echo $dal->getAllAlbums();
  break;
}

//verifyAPIkey return 1 if it exists and 0 if it doesn't -1 for errors

    /*this is meant to be the reply from the server, originally the php would fetch this from DB
    $reply = '{ "User" : { "Name"  : "John Doe", "cash" : 700 },
   "Catalog"  : [
      { "Name"  : "Album1", "price" : 100, "Discount" : 10 },
      { "Name"  : "Album2", "price" : 130, "Discount" : 20 },
      { "Name"  : "Album3", "price" : 130, "Discount" : 20 },
      { "Name"  : "Album4", "price" : 130, "Discount" : 20 }
   ]
}    ';*/
