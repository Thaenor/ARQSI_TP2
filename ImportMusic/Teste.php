<?php

    require_once('nusoap.php');
    require_once ('DAL2.php');


    $dal=new dal();

    $conn=$dal->db_connect();

    if ($conn) echo "Connection OK";

    $dal->createTable($conn);

    /*$name='xxxxx';
    $loja='yyyyyy';
    $quantidade=100;
    $dal->db_insertData_InfoVendas($link,$name,$loja,$quantidade );//funcional se a tabela não estiver criada vai criala
    $dal->db_dropTable_InfoVendas($link);//funcional*/

    $name='ABC';
    $prod='xpto';
    $price=10.95;
    $dal->insertSales($name,$prod,$price);
    $dal->db_close($conn);
?>