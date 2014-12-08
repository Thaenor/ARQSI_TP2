<?php
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
require_once 'DAL.php';

$dal=new dal();

$AlbumName = "Concertina";
$AlbumArtist = "Francisco";
$AmountStock = 15;
$UnitPrice = 56.6;

$result = $dal->insertAlbum("Words To The Blind","Savages", 20, 10, 50);
$result = $dal->insertAlbum("A New Testament","Christopher Owens", 20, 10, 50);
$result = $dal->insertAlbum("Time To Die","Electric Wizard", 20, 10, 50);
$result = $dal->insertAlbum("Cheek to Cheek","Tony Bennett", 20, 10, 50);
$result = $dal->insertAlbum("Power","Fryars", 20, 10, 50);
$result = $dal->insertAlbum("La Petite Mort","James", 20, 10, 50);
$result = $dal->insertAlbum("Modern Vices","Modern Vices", 20, 10, 50);
$result = $dal->insertAlbum("More Lies from the Gooseberry Bush","Teenage Guitar", 20, 10, 50);
$result = $dal->insertAlbum("Tell 'Em I'm Gone","Yusuf / Cat Stevens", 20, 10, 50);
$result = $dal->insertAlbum("Popular Problems","Leonard Cohen", 20, 10, 50);
echo "<h1>done</h1>";

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
