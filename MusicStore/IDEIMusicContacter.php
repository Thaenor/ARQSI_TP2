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

//verify API KEY
if( $dal->verifyLocalAPI_KEY($adminName) == 0 || $dal->verifyLocalAPI_KEY($adminName) == -1){
    echo 'ERROR getting API KEY';
    return;
}else {
    $API = $dal->verifyLocalAPI_KEY($adminName);
}

if( $dal->verifyIDEIMusicAPI_KEY($adminName,$API) == 0 || $dal->verifyIDEIMusicAPI_KEY($adminName,$API) == -1){
    echo 'ERROR matching API KEY with IDEIMusic, BLAME THEM!';
    return;
}else {
    echo $jsonReply = $dal->getAllAlbumsFromIDEIMusic($API);
}
