<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

    require_once('lib/nusoap.php');

    //$ns='urn:WSImportMusicServer';

    $client = new nusoap_client ( 'http://localhost/Ana/ImportMusic/WSImportMusicServer.php');

	if ( $client->getError() ) {
        print "<h2>Soap Constructor Error:</h2><pre>".
            $client->getError()."</pre>";
    }

	//$params = array('store'=>'abc', 'prod'=>'xpto','price'=>10.95);
    echo'alguma coisa antes de inserir';

    $result = $client->call('recordSale',array('store'=>'abc', 'prod'=>'xpto','price'=>10.95));

    echo'depois de inserir';

    echo $result;

?>