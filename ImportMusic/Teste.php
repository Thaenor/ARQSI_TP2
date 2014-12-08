<?php

    require_once('lib/nusoap.php');
    require_once ('DAL.php');


    $dal=new dal();

    $name='ABC';
    $prod='xpto';
    $price=10.95;
    $result = $dal->insertSales($name,$prod,$price);
    echo $result;
?>