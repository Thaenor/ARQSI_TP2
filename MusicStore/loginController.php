<?php
include 'core/init.php';


if(empty($_POST) === false) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($username) || empty($password)){
    $errors[] = 'you need to enter a user and pass';
  } else if( $dal->validLogin($username, $password) == false) {
      $errors[] = 'I\'m sorry, we couldn\'t find your credentials in our database, please try again';
  }
  print_r($errors);
}

echo "welcome $username";
//TODO: add login logic here

?>
