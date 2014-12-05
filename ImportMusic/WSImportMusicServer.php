<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

#includes necessario ao funcionamento do serviço
    require_once("lib/nusoap.php");
    require_once("DAL2.php");

    //$dal= new DAL();

#criaçao de um instancia do serviço
    $server=new soap_server();

#configuração do WSDL
    $server->configureWSDL('WSImportMusicServer','urn:WSImportMusicServer');

#definição de dados de input, isto é, o que vai ser guardado na BD
    $input=array("StoreName"=>'xsd:string', "Prod"=>'xsd:string',"price"=>'xsd:decimal');

    $output=array('return'=>'xsd:string');

#registo do serviço
    $server->register('recordsale',$input,$output,
        'urn:WSImportMusicServer','urn:WSImportMusicServer/recordSale');

#requitos para uso de serviço
    $HTTP_RAW_POST_DATA= isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
    $server->service($HTTP_RAW_POST_DATA);

#função que faz o insert
	function recordSale($Store,$Prod,$Price){
        //gravar vendas na base de dados

        #cria uma instancia da DAL
        $dal = new DAL();

        #$Table="SalesRecord";

#chamada da funcao
        $dal->insertSales($Store,$Prod,$Price);
    }
?>