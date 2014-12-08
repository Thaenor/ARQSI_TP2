<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    require_once('DAL.php');
    
    require_once('lib/nusoap.php');

    $server=new soap_server;

    //$server->configureWSDL('WSImportMusicServer','urn:WSImportMusicServer');

    //$input=array('store'=>'xsd:string', 'prod'=>'xsd:string','price'=>'xsd:decimal');

    //$output=array('return'=>'xsd:string');

    //$server->register('recordSale',$input,$output,'urn:WSImportMusicServer','urn:WSImportMusicServer/recordSale');

    $server->register('recordSale');

    function recordSale($input,$prod,$price){
       

        $dal = new DAL();

        $result = $dal->insertSales($input,$prod,$price);

        return $result;
    }
    // Use the request to (try to) invoke the service
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
    $server->service($HTTP_RAW_POST_DATA);

?>