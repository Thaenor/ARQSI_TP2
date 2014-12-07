<?php
//"SOU UM BURRO STRESSADO!!"

class DAL {
  /*private $DB_HOST = 'localhost';
  private $DB_HOST2 = '172.31.100.24';
  private $DB_USER = 'arqsi';
  private $DB_PASS = 'arqsi1415';
  private $DB_NAME = 'DBMusicStore';*/
  private $DB_HOST = 'localhost';
  private $DB_HOST2 = '172.31.100.24';
  private $DB_USER = 'root';
  private $DB_PASS = 'root';
  private $DB_NAME = 'MusicStore';

  private $CREATE_USERS_TABLE_SCRIPT = 'CREATE TABLE IF NOT EXISTS USERS (
    `UserID` VARCHAR(40) NOT NULL ,
    `Password` varchar(32) NOT NULL,
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
    `AlbumID` varchar(40) NOT NULL,
    `AlbumName` varchar(80) NOT NULL,
    `Artist` varchar(80) NOT NULL,
    `AmountStock` INT NOT NULL,
    `UnitPrice` DECIMAL(5,2) NOT NULL,
    PRIMARY KEY(AlbumID)
  )ENGINE=MyISAM DEFAULT CHARSET=latin1;' ;

  function db_mysqliconn() {
    $mysqli = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
    if(mysqli_connect_error()){
      $mysqli = new mysqli($this->DB_HOST2, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
      if(mysqli_connect_error())
      return null;
    }

    return $mysqli;
  }

  ///////////////////////////////////////// INSERTS /////////////////////////////////////////

  function insertAlbum($AlbumID, $AlbumName,$AlbumArtist, $AmountStock, $UnitPrice) {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ALBUM_TABLE_SCRIPT);

    if($recordset) {
      ?>
      <script type="application/javascript">
        alert("SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `ALBUM` (`AlbumID`,`AlbumName`,`AlbumArtist`,`AmountStock`,`UnitPrice`) VALUES ('$AlbumID','$AlbumName','$AlbumArtist','AmountStock','UnitPrice')";

    $result = mysqli_query($mysqli, $sql);

    if($result) {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - FALHOU!");
      </script>
      <?php
    }
  }

  function insertItemSale($SaleID, $AlbumID, $Quantity)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {
      ?>
      <script type="application/javascript">
        alert("SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `ITEMSALE` (`SaleID`,`AlbumID`,`Quantity`,`AmountStock`,`UnitPrice`) VALUES ('$SaleID','$AlbumID','$Quantity')";

    $result = mysqli_query($mysqli, $sql);

    if($result) {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - FALHOU!");
      </script>
      <?php
    }
  }

  function insertSale($UserID, $SaleDate)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {
      ?>
      <script type="application/javascript">
        alert("SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `SALE` (`UserID`,`SaleDate`) VALUES ('$UserID','$SaleDate')";

    $result = mysqli_query($mysqli, $sql);

    if($result) {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - FALHOU!");
      </script>
      <?php
    }
  }

  function insertUser($UserID, $Password)
  {
    $mysqli = $this-> db_mysqliconn();

    // por precaucao pede-se para criar a tabela CASO(SE) esta nao exista
    $recordset = $mysqli->query($this->CREATE_ITEMSALE_TABLE_SCRIPT);

    if($recordset) {
      ?>
      <script type="application/javascript">
        alert("SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("FALHOU!");
      </script>
      <?php
    }

    $sql = "INSERT INTO `USERS` (`UserID`,`Password`) VALUES ('$UserID','$Password')";

    $result = mysqli_query($mysqli, $sql);

    if($result) {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - SUCESSO!");
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="application/javascript">
        alert("Resultado do pedido de insercao de pedido da TAG - FALHOU!");
      </script>
      <?php
    }
  }

  ////////////////////////////////////////// GETS ///////////////////////////////////////////

  function getAllAlbuns(){
    $mysqli = $this->db_mysqliconn();
    if($mysqli){
      $strquery = "SELECT * FROM `ALBUM`";
      $recordset = $mysqli->query($strquery);
      return $recordset;
    }
    return null;
  }

  function getAlbumInfo($AlbumID){
    $mysqli = $this->db_mysqliconn();
    if($mysqli){
      $strquery = "SELECT * FROM `ALBUM` WHERE AlbumID = $AlbumID";
      $recordset = $mysqli->query($strquery);
      return $recordset;
    }
    return null;
  }

  function validLogin($UserID, $Password)
  {
    $mysqli = $this->db_mysqliconn();
    if($mysqli){
      $strquery = "SELECT * FROM `users` WHERE UserID = '$UserID' AND Password = '$Password'";
      $recordset = $mysqli->query($strquery);
      if ($recordset->num_rows > 0) {
        $row = $recordset->fetch_assoc();
        if ($row["API_KEY"]) {
          return 1; //Admin
        }
        else
        {
          return 2; //Client
        }
      }
      else
      {
        return 0; // Error
      }
      return $recordset;
    }
    return null;
  }

  function db_close() {
    $mysqli= $this->db_mysqliect();
    mysqli_close($mysqli);
  }
}
?>
