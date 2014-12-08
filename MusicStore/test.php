<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once('lib/nusoap.php');
// Create a new soap client based on the service's metadata (WSDL)
$url = "http://wvm024.dei.isep.ipp.pt/ideimusic/IDEIMusicService.svc?wsdl";
$client = new SoapClient($url,array("trace" => 1, "exception" => 0));
$params = array('adminLojaID' => '8f3f21dd-5938-43ac-a1dd-10407d45db69');
$result = $client->getAllAlbumsFromIDEIMusic($params);
echo $result->getAPI_KEYResult;
?>
