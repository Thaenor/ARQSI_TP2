<?php
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
require_once 'DAL.php';

$dal = new DAL();

$adminName = $_REQUEST['adminName'];
$adminConfirm = $dal->getAdmin();

if($adminName != $adminConfirm){
    echo 'You shall not pass! '.$adminName.' and '.$adminConfirm.' are not the same person';
    return;
}

$API = $dal->getAdminAPI();
echo $jsonReply = $dal->getAllAlbumsFromIDEIMusic($API);

//verify API KEY
/*if( $dal->verifyLocalAPI_KEY($adminName) == 0 || $dal->verifyLocalAPI_KEY($adminName) == -1){


    $NewAPI = $dal->getAPI_KEYIDEIMusic($adminConfirm);

    //our error message
    if( strpos($NewAPI, 'Not') ){
      echo $NewAPI;
      return;
    } else {
      $dal->insertAPI_KEY($adminConfirm,$NewAPI);
      echo $jsonReply = $dal->getAllAlbumsFromIDEIMusic($NewAPI);
    }

}else {
    $API = $dal->getAdminAPI();
    echo $jsonReply = $dal->getAllAlbumsFromIDEIMusic($API);
    return;
}*/
