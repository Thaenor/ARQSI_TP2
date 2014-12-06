<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    require_once('lib/nusoap.php');
    require_once('DAL.php');

    $server=new soap_server;

    $server->configureWSDL('WSImportMusicServer','urn:WSImportMusicServer');

    $input=array('StoreName'=>'xsd:string', 'Prod'=>'xsd:string','price'=>'xsd:decimal');

    $output=array('return'=>'xsd:string');

    $server->register('recordSale',$input,$output,'urn:WSImportMusicServer','urn:WSImportMusicServer/recordSale');

    $server->register('recordSale');

    function recordSale($store,$prod,$price){
       echo'Record Sales function';
            //gravar vendas na base de dados
       echo 'ola';

        $dal = new DAL();
        $conn=$dal->db_connect();
        if ($conn) echo "Connection OK";

        $dal->createTable($conn);
        $dal->insertSales($store,$prod,$price);
    }
    // Use the request to (try to) invoke the service
    $HTTP_RAW_POST_DATA= isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
    $server->service($HTTP_RAW_POST_DATA);
?>