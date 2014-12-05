<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    require_once('lib/nusoap.php');

    echo'Ola Servico!';
    $ns="urn:WSImportMusicServer";

    $WSDL_uri="http://localhost/WSnusoap/WSImportMusicServer.php?wsdl";

    $client = new nusoap_client ( $WSDL_uri,'wsdl' );
    if ( $client->getError() ) {
        print "<h2>Soap Constructor Error:</h2><pre>".
            $client->getError()."</pre>";
    }
    $params=array("StoreName"=>"abc", "Prod"=>"xpto","price"=>10.95);
    $result = $client->call( "recordsale", array("parameters"=>$params), $ns);
    echo"$result";

?>