<?php 
include("DAL.php");
$dal = new DAL();

$url="batatas";

$dal->insertTagRequest($url);

$res=$dal->getTagRequests();

print_r($res);
?>