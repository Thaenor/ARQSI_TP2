<?php
//"SOU UM BURRO STRESSADO!!"
error_reporting(0);
require_once('lib/nusoap.php');
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
class DAL {

    private $DB_HOST = 'localhost';
    private $DB_USER = 'root';
    private $DB_PASS = '';
    private $DB_NAME = 'dbmusicstore';

  private $CREATE_USERS_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS USERS (
    `UserID` VARCHAR(40) NOT NULL ,
    `Password` varchar(32) NOT NULL,
    `Type` INT NOT NULL,
    `API_KEY` varchar(16),
    PRIMARY KEY(UserID)
  )ENGINE=MyISAM DEFAULT CHARSET=latin1;';


  private $CREATE_SALE_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS SALE (
    `SaleID` INT NOT NULL auto_increment ,
    `UserID` varchar(40) NOT NULL,
    `SaleDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(SaleID),
    UNIQUE(SaleID)
  )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

  private $CREATE_ITEMSALE_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS ITEMSALE (
    `SaleID` INT NOT NULL,
    `AlbumID` varchar(40) NOT NULL,
    `Quantity` INT NOT NULL DEFAULT 1,

    CONSTRAINT PK_ITEM_SALE PRIMARY KEY (SaleID, AlbumID),
    CONSTRAINT FK_ITEM_SALE_SALEID FOREIGN KEY (SaleID) REFERENCES SALE (SaleID),
    CONSTRAINT FK_ITEM_SALE_ALBUMID FOREIGN KEY (AlbumID) REFERENCES ALBUM (AlbumID)

  )ENGINE=MyISAM DEFAULT CHARSET=latin1;';

  private $CREATE_ALBUM_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS ALBUM (
    `AlbumID` INT NOT NULL auto_increment ,
    `AlbumName` varchar(80) NOT NULL,
    `AlbumArtist` varchar(80) NOT NULL,
    `AmountStock` INT NOT NULL,
    `UnitPrice` DECIMAL(5,2) NOT NULL,
    `Discount` INT,
    PRIMARY KEY(AlbumID)
  )ENGINE=MyISAM DEFAULT CHARSET=latin1;' ;

  function db_mysqliconn() {
            $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
            if(mysqli_connect_error())
                return null;
            return $mysqli;
        }

  ///////////////////////////////////////// INSERTS /////////////////////////////////////////

  function insertAlbum($AlbumName,$AlbumArtist, $AmountStock, $UnitPrice,$Discount) {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ALBUM_TABLE_SCRIPT);

    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU a verificar a tabela!");
      </script>
      <?php
    }
    if($Discount != 0){
      $sql = "INSERT INTO `ALBUM` (`AlbumName`,`AlbumArtist`,`AmountStock`,`UnitPrice`,`Discount`) VALUES ('$AlbumName','$AlbumArtist',$AmountStock,$UnitPrice,$Discount)";
    }
    else
      $sql = "INSERT INTO `ALBUM` (`AlbumName`,`AlbumArtist`,`AmountStock`,`UnitPrice`) VALUES ('$AlbumName','$AlbumArtist',$AmountStock,$UnitPrice)";

    $result = mysqli_query($mysqli, $sql);
    $this->db_close();
    return $result;
  }

  function insertItemSale($SaleID, $AlbumID, $Quantity)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU a verificar a tabela!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `ITEMSALE` (`SaleID`,`AlbumID`,`Quantity`,`AmountStock`,`UnitPrice`) VALUES ('$SaleID','$AlbumID','$Quantity')";

    $result = mysqli_query($mysqli, $sql);
    $this->db_close();
    return $result;
  }

  function insertSale($UserID, $cart)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar as tabelas CASO(SE) esta nao existam
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);
    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU a verificar a tabela!");
      </script>
      <?php
    }
    $recordset = $mysqli->query($this->CREATE_SALE_TABLE_SCRIPT);
    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU a verificar a tabela!");
      </script>
      <?php
    }

    $sqlSale = "INSERT INTO `SALE` (`UserID`) VALUES ('$UserID')";
    $result = mysqli_query($mysqli, $sql);

    $sqlGetSaleID = "SELECT LAST(`SaleID`) FROM `Sale`;";
    $lastSaleID = mysql_query($mysqli, $lastSaleID);

    $numberSales = 0;

    foreach ($cartRow as $cart) {
      $AlbumID = $cartRow["AlbumID"];
      $Quantity = $cartRow["Quantity"];

      $sqlSale = "INSERT INTO `ITEMSALE` (`SaleID`,`AlbumID`,`Quantity`) VALUES ('$lastSaleID','$AlbumID',$Quantity)";
      $result = mysqli_query($mysqli, $sql);
      if($result)
        $numberSales = $numberSales + 1;
    }

    $this->db_close();
    return $numberSales;
  }

  function insertClient($UserID, $Password)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU a verificar a tabela!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `USERS` (`UserID`,`Password`,`Type`) VALUES ('$UserID','$Password',2)";

    $result = mysqli_query($mysqli, $sql);
    $this->db_close();
    return $result;
  }

  function insertAdmin($UserID, $Password)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `USERS` (`UserID`,`Password`,`Type`) VALUES ('$UserID','$Password',1)";

    $result = mysqli_query($mysqli, $sql);
    $this->db_close();
    return $result;
  }


    //////////////////////////////////////////////WEB SERVICES//////////////////////////////////////////////////

    /****************************************** MusicStore -> IMPORTMUSIC *********************************************/
    function insertToImportMusic($adminID,$albumName,$price)
    {
        $client = new nusoap_client('http://localhost:8080/ImportMusic/WSImportMusicServer.php');

        if ( $client->getError() ) {
            print "<h2>Soap Constructor Error:</h2><pre>".
                $client->getError()."</pre>";
        }

        $result = $client->call('recordSale',array('store'=>$adminID, 'prod'=>$albumName,'price'=>$price));

        return $result;
    }

    /****************************************** MS -> IDEIMUSIC *********************************************/
    function getAllAlbumsFromIDEIMusic()
    {

      $client = new nusoap_client('http://wvm024.dei.isep.ipp.pt/ideimusic/IDEIMusicService.svc?singleWsdl');

      if ( $client->getError() ) {
            print "<h2>Soap Constructor Error:</h2><pre>".$client->getError()."</pre>";
        }

      ////////////problema é aqui!///////////
      $result = $client->get('getAllAbums');
      ///////////////////////////////////////

      return $result->getAllAbumsResult;
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////


  ////////////////////////////////////////// GETS ///////////////////////////////////////////

  function getAllAlbums(){
    $mysqli = $this->db_mysqliconn();
    $strquery = 'SELECT * FROM `ALBUM`';

    if($mysqli){
      $recordset = $mysqli->query($strquery);

      $results = array();

      if ($recordset->num_rows > 0) {
        foreach ($recordset as $row) {
          array_push($results, $row);
        }
      }
      $this->db_close();
      return json_encode($results);
    }
    $this->db_close();
    return false;
  }

  function getAlbumInfo($AlbumID){
    $mysqli = $this->db_mysqliconn();
    $strquery = "SELECT * FROM `ALBUM` WHERE AlbumID = $AlbumID";

    if($mysqli){
      $recordset = $mysqli->query($strquery);

      $results = array();

      if ($recordset->num_rows > 0) {
        $row = $recordset->fetch_assoc();
        $this->db_close();
        return json_encode($row);
      }
      $this->db_close();
      return $recordset;
    }
    $this->db_close();
    return null;
  }

  function getAdmin()
  {
    $mysqli = $this->db_mysqliconn();
    $strquery = "SELECT `UserID` FROM `USERS` WHERE `Type` = 1";

    if($mysqli){
      $recordset = $mysqli->query($strquery);

      $results = array();

      if ($recordset->num_rows > 0) {
        $row = $recordset->fetch_assoc();
        $this->db_close();
        return $row["UserID"];
      }
      $this->db_close();
      return $recordset;
    }
    $this->db_close();
    return null;
  }

  function validLogin($UserID, $Password)
  {
    $mysqli = $this-> db_mysqliconn();
    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_USERS_TABLE_SCRIPT);
    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">alert("FALHOU a verificar a tabela!");</script>
      <?php
    }
    if($mysqli){
      $strquery = "SELECT * FROM `users` WHERE UserID = '$UserID' AND Password = '$Password'";
      $recordset = $mysqli->query($strquery);
      if ($recordset->num_rows > 0) {
        $row = $recordset->fetch_assoc();
        if ($row["Type"] == "1") {
          $this->db_close();
          return 1; //Admin
        }
        if ($row["Type"] == "2") {
          $this->db_close();
          return 2; //Client
        }
      }
      else
      {
        $this->db_close();
        return 0; // Error
      }
    }
    $this->db_close();
    return null;
  }

  function verifyAPI_KEY($userID)
  {
    $mysqli = $this->db_mysqliconn();
    if($mysqli){
      $strquery = "SELECT API_KEY FROM `users` WHERE UserID = '$userID'";
      $recordset = $mysqli->query($strquery);
      if ($recordset->num_rows > 0) {
        $row = $recordset->fetch_assoc();
        if ($row["API_KEY"]) {
          $this->db_close();
          return 1;
        }
        else
        {
          $this->db_close();
          return 0;
        }
      }
    }
    $this->db_close();
    return -1;
  }

  function insertAPI_KEY($userID, $API_KEY)
  {
    $mysqli = $this->db_mysqliconn();
    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_USERS_TABLE_SCRIPT);
    if($recordset) {} else
    {
      ?>
      <script type="application/javascript">alert("FALHOU a verificar a tabela!");</script>
    <?php
    }
    $sql = "UPDATE `users` SET `API_KEY`='$API_KEY' WHERE `UserID`='$userID'";
    $result = mysqli_query($mysqli, $sql);
    $this->db_close();
    return $result;
  }

  function sanitize($sqlString){
        $mysqli = $this->db_mysqliconn();
        return $mysqli->real_escape_string($sqlString);
    }

  function db_close() {
    $mysqli= $this->db_mysqliconn();
    mysqli_close($mysqli);
  }
}
?>
