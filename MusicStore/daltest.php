<?php

require_once 'DAL.php';

$dal=new dal();

$AlbumName = "Concertina";
$AlbumArtist = "Francisco";
$AmountStock = 15;
$UnitPrice = 56.6;

//OK//$result = $dal->insertAlbum($AlbumName,$AlbumArtist, $AmountStock, $UnitPrice);
//OK//echo " <-> inserir album: ".$result;

//OK//$result = $dal->getAllAlbums();
//OK//echo " <-> obter JSON dos albums: ".$result;

//OK//$result = $dal->getAlbumInfo(6);
//OK//echo " <-> obter JSON de um album: ".$result;

//OK//$result = $dal->insertAdmin('admin','qwerty');
//OK//echo "inserir admin: ".$result;

//OK//$result = $dal->insertClient('Francisco','qwerty');
//OK//echo " <-> inserir user: ".$result;

//OK//$result = $dal->validLogin('admin','qwerty');
//OK//echo " <-> validar login: ".$result;

//OK//$result = $dal->verifyAPI_KEY('admin');
//OK//echo " <-> verificar api_key de 'admin': ".$result;

//OK//$result = $dal->insertAPI_KEY('admin','123456-123456');
//OK//echo " <-> inserir api_key no 'admin': ".$result;