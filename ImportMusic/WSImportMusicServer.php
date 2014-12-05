<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    require_once("lib/nusoap.php");
    require_once("DAL2.php");

    //$dal= new DAL();
    $server=new soap_server();

    $server->configureWSDL('WSImportMusicServer','urn:WSImportMusicServer');

    $input=array("StoreName"=>'xsd:string', "Prod"=>'xsd:string',"price"=>'xsd:decimal');

    $output=array('return'=>'xsd:string');

    $server->register('recordsale',$input,$output,
        'urn:WSImportMusicServer','urn:WSImportMusicServer/recordSale');

    $HTTP_RAW_POST_DATA= isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
    $server->service($HTTP_RAW_POST_DATA);

	function recordSale($Store,$Prod,$Price){
        //gravar vendas na base de dados

        $dal = new DAL();

        $Table="SalesRecord";

        $dal->insertSales($Store,$Prod,$Price);
    }
?>