<?php
    //"SOU UM BURRO STRESSADO!!"
    class DAL {
        private $DB_HOST = 'localhost';
        private $DB_USER = 'root';
        private $DB_PASS = '';
        private $DB_NAME = 'lastfmWidget';
        private $CREATE_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS REQUESTS (
                                            `ID` int(11) NOT NULL auto_increment PRIMARY KEY,
                                            `Type` varchar(10) NOT NULL,
                                            `Search_url` varchar(250) NOT NULL,
                                            `Time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                            UNIQUE (ID)
                                        )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

        function db_mysqliect() {
            $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
            if(mysqli_connect_error())
                return null;
            return $mysqli;
        }
        
        ////////////////////////////////////////// GETS ///////////////////////////////////////////
        function getTagRequests() {
            $mysqli = $this-> db_mysqliect();
            if($mysqli) {
                $strquery = "SELECT * FROM `REQUESTS` where Type = \"tag\"";
                $recordset = $mysqli->query($strquery);
                return $recordset;
            }
            return null;
        }
        
        function getTrackRequests() {
            $mysqli = $this-> db_mysqliect();
            if($mysqli) {
                
                $strquery = "SELECT * FROM `REQUESTS` where Type = \"track\"";
                $recordset = $mysqli->query($strquery);
                return $recordset;
            }
            return null;
        } 
        
        function getEventRequests() {
            $mysqli = $this-> db_mysqliect();
            if($mysqli) {
                
                $strquery = "SELECT * FROM `REQUESTS` where Type = \"event\"";
                $recordset = $mysqli->query($strquery);
                return $recordset;
            }
            return null;
        }
        
        function getArtistRequests() {
            $mysqli = $this-> db_mysqliect();
            if($mysqli) {
                
                $strquery = "SELECT * FROM `REQUESTS` where Type = \"artist\"";
                $recordset = $mysqli->query($strquery);
                return $recordset;
            }
            return null;
        }
        
        ///////////////////////////////////////// INSERTS /////////////////////////////////////////
        
        function insertTagRequest($tagRequestUrl) {
            $mysqli = $this-> db_mysqliect();
            
            // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
            $recordset = $mysqli->query($this->CREATE_TABLE_SCRIPT);
            
            if($recordset) {
                ?> 
                <script type="application/javascript"> 
                    alert("SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("FALHOU!") 
                </script>
                <?php
            }
            
            $sql = "INSERT INTO `REQUESTS` (`Type`,`Search_url`) VALUES ('tag','$tagRequestUrl')";
            
            $result = mysqli_query($mysqli, $sql);
            
            if($result) {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido da TAG - SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido da TAG - FALHOU!") 
                </script>
                <?php
            }
        }
        
        function insertTrackRequest($trackRequestUrl) {
           $mysqli = $this-> db_mysqliect();
            
            // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
            $recordset = $mysqli->query($this->CREATE_TABLE_SCRIPT);
            
            if($recordset) {
                ?> 
                <script type="application/javascript"> 
                    alert("SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("FALHOU!") 
                </script>
                <?php
            }
            
            $sql = "INSERT INTO `REQUESTS` (`Type`,`Search_url`) VALUES ('track','$trackRequestUrl')";
            
            $result = mysqli_query($mysqli, $sql);
            
            if($result) {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido da TRACK - SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido da TRACK - FALHOU!") 
                </script>
                <?php
            }
        }
        
        function insertEventRequest($eventRequestUrl) {
            $mysqli = $this-> db_mysqliect();
            
            $recordset = $mysqli->query($this->CREATE_TABLE_SCRIPT);
            
            if($recordset) {
                ?> 
                <script type="application/javascript"> 
                    alert("SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("FALHOU!") 
                </script>
                <?php
            }
            
            $sql = "INSERT INTO `REQUESTS` (`Type`,`Search_url`) VALUES ('event','$eventRequestUrl')";
            
            $result = mysqli_query($mysqli, $sql);
            
            if($result) {
               /* ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido do EVENT - SUCESSO!") 
                </script>
                <?php*/
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido do EVENT - FALHOU!") 
                </script>
                <?php
            }
        }
        
        function insertArtistRequest($ArtistRequestUrl) {
            $mysqli = $this-> db_mysqliect();
            
            // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
            $recordset = $mysqli->query($this->CREATE_TABLE_SCRIPT);
            
            if($recordset) {
                ?> 
                <script type="application/javascript"> 
                    alert("SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("FALHOU!") 
                </script>
                <?php
            }
            
            $sql = "INSERT INTO `REQUESTS` (`Type`,`Search_url`) VALUES ('artist','$ArtistRequestUrl')";
            
            $result = mysqli_query($mysqli, $sql);
            
            if($result) {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido do ARTIST - SUCESSO!") 
                </script>
                <?php
            }
            else
            {
                ?> 
                <script type="application/javascript"> 
                    alert("resultado do pedido de insercao de pedido do ARTIST - FALHOU!") 
                </script>
                <?php
            }
        }
        
        function db_close() {
            $mysqli= $this->db_mysqliect();
            mysqli_close($mysqli);
        }
    }
?>