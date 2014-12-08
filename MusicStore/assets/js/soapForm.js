var catalog = new Array();
var cart = new Array();


function showSoapOrder(){
  var container = document.getElementByid('CatalogDisplay');

  container
}

function AjaxSoapOrder()
{
  var xmlhttp;
  if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            try{
                CompileCatalog(xmlhttp.responseText);
                var json = JSON.parse(xmlhttp.responseText);
            } catch(err){
              console.log(err.message);
              //logout();
              //location.reload();
            }
          }
        }
        xmlhttp.open("GET","IDEIMusicContacter.php?adminName="+readCookie('username'),true);
        xmlhttp.send();
}

function CompileCatalog(json){
  for(var x=0; x<json.length; x++){
    catalog.push( new product(json[x].AlbumID, json[x].Name, json[x].Artist, json[x].StockAmount, json[x].UnitPrice, json[x].Discount,0) );
    //console.log(json[x].AlbumID+" | " +json[x].Name+" | " +json[x].Artist+" | " +json[x].StockAmount+" | " +json[x].UnitPrice+" | " +json[x].Discount);
    //console.log(catalog[x].id+" | "+catalog[x].name+" | "+catalog[x].artist+" | "+catalog[x].amountStock+" | "+catalog[x].price+" | "+catalog[x].discount+" | "+catalog[x].quantity);
  }
  printCatalog();
}
