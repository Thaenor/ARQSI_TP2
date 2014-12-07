<?php
/**
 * Created by PhpStorm.
 * User: thaenor
 * Date: 05/12/14
 * Time: 18:09
 */

//include 'core/init.php';

if(empty($_POST) === false) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $REpassword = $_POST['REpassword'];

    if(empty($username) || empty($password) || empty($REpassword)){
        $errors[] = 'you need to enter a user and pass';
    } else if($password != $REpassword){
        $errors[] = 'sorry but the passwords do not match';
    } /*else if( $dal->insertUser($username,$password) == false ){
        $errors[] = 'something went wrong, check your Internet connection and try again in a few minutes. If this problem persists please bother the developers';
    }*/
    $dal->insertUser($username,$password);

    print_r($errors);
}

echo 'you have registered successfully';