<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
	
	class DAL{
	
		//private $db_name='DBImportMusic';
		//private $db_host='172.31.100.24';
		//private $db_user='arqsi';
		//private $db_pass='arqsi1415';
		private $DB_HOST="localhost";
		private $DB_USER="root";
		private $DB_PASS="";
		private $DB_NAME='dbimportmusic';
		
        
        
        function db_mysqliconn() {
            $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
            if(mysqli_connect_error())
                return null;
            return $mysqli;
        }

        function db_close(){
            $mysqli= $this->db_mysqliconn();
            mysqli_close($mysqli);
         }


		function insertSales($StoreName, $Prod, $price){
            $mysqli = $this->db_mysqliconn();
            
            $CREATE_SALES_RECORD_TABLE = "create table if not exists SalesRecord(
				  ID int (11) NOT NULL auto_increment,
				  StoreName varchar(50),
				  Product varchar (50),
				  Price decimal (5,2),
				  Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (ID),
				  UNIQUE (ID)
				  )";
            
            // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
            $recordset = $mysqli->query($CREATE_SALES_RECORD_TABLE);
            
            $sql = "INSERT INTO salesrecord(StoreName,Product,Price) VALUES ('$StoreName','$Prod',$price)";

            $result = mysqli_query($mysqli, $sql);
            $this->db_close();
            return $result;
		}
	}
?>