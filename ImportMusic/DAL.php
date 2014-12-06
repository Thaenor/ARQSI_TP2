<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
	
	class DAL{
	
		//private $db_name='DBImportMusic';
		//private $db_host='172.31.100.24';
		//private $db_user='arqsi';
		//private $db_pass='arqsi1415';
		private $db_name='DBImportMusic';
		private $db_host="localhost";
		private $db_user="root";
		private $db_pass="";
		
		function db_connect(){
			$conn= new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			echo 'olaaa';
			if (!$conn) echo "test";
			if(mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . $conn->connect_error;
			}
			return $conn;
		}

        function db_close($conn){

            mysqli_close($conn);
         }

		function createTable($conn)
        {
            $query = "create table if not exists SalesRecord(
				  ID int (11) NOT NULL auto_increment,
				  StoreName varchar(50),
				  Product varchar (50),
				  Price decimal (5,2),
				  Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (ID),
				  UNIQUE (ID)
				  )";
            $result = mysqli_query($conn, $query);
        }

		function insertSales($StoreName, $Prod, $price){
		
			$conn = $this->db_connect();
            //echo $conn;
			//$recordset = $conn->query($this->CREATE_TABLE_SCRIPT);

			if($conn){
				$strquery="INSERT INTO salesrecord(StoreName,Product,Price) VALUES ('$StoreName','$Prod',$price)";
                $result =$conn->query($strquery);
                echo $result;
                return $result;
            }

		}
	}
?>