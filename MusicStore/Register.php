<?php
/**
* Created by PhpStorm.
* User: thaenor
* Date: 05/12/14
* Time: 18:09
*/

error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
require_once 'DAL.php';
$dal = new DAL();

//read values from client
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

if(isset($_REQUEST['REpassword'])){
  $password2 = $_GET['REpassword'];
}
else
echo 'ERROR: second password not set';

//its safe to assign them now
$username = $_GET['username'];
$password = $_GET['password'];
$REpassword = $_GET['REpassword'];

//some verifications, the fields can't be empty and passwords need to match
if(empty($username) || empty($password) || empty($REpassword) ){
  $errors[] = 'you need to enter a user and pass and confirmation of password';
} else if($password != $REpassword){
  $errors[] = 'sorry but the passwords do not match';
}

//insert users in DB

//prevents SQL injection
$username = $dal->sanitize($username);
$password = $dal->sanitize($password);

  $flag = $dal->insertClient($username,$password);
  if($flag == 1)
    echo 'YES';
  else { echo'NO'; }
