<?php
    include 'DAL2.php';

    $dal=new dal();

    $conn=$dal->db_connect();

    if ($conn) echo "fuck yea";

    $dal->createTable($conn);

    /*$name='xxxxx';
    $loja='yyyyyy';
    $quantidade=100;
    $dal->db_insertData_InfoVendas($link,$name,$loja,$quantidade );//funcional se a tabela não estiver criada vai criala
    $dal->db_dropTable_InfoVendas($link);//funcional*/

    $dal->insertSales("ABC","xpto","10.55");
    $dal->db_close($conn);
?>