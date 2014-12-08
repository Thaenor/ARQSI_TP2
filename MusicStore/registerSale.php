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

$dal = new DAL();
$clientReplyJSON = $_REQUEST['stringJSON'];
$userID = $_REQUEST['username'];

$clientReply = json_decode($clientReplyJSON);

$AdminName = $dal->getAdmin();

//$dal->insertSale($userID, $clientReply);
echo $dal->insertSale($userID, $clientReply);
//print_r($clientReply);
//foreach ($clientReply as &$value) {

  //send "store sale" to ImportMusic

  //send "store sale" to MusicStore

//feedback the user