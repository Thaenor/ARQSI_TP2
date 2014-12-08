var catalog = new Array();
var cart = new Array();
var Tprice = 0;

var username;

function compileCatalog(json, user){
  username = user;

  for(var x=0; x<json.length; x++){
    catalog.push( new product(json[x].AlbumID, json[x].AlbumName, json[x].AlbumArtist, json[x].AmountStock, json[x].UnitPrice, json[x].Discount,0) );
    //console.log(json[x].AlbumID+" | " +json[x].AlbumName+" | " +json[x].AlbumArtist+" | " +json[x].AmountStock+" | " +json[x].UnitPrice+" | " +json[x].Discount);
    //console.log(catalog[x].id+" | "+catalog[x].name+" | "+catalog[x].artist+" | "+catalog[x].amountStock+" | "+catalog[x].price+" | "+catalog[x].discount+" | "+catalog[x].quantity);
  }

  printCatalog();
}

function printCatalog(){

  var container = document.getElementById('CatalogDisplay');
  container.innerHTML = "name | price | discount <hr>";
  container.innerHTML += "";

  for(var x=0; x<catalog.length; x++){
    container.innerHTML += catalog[x].name+" | "+catalog[x].price + " | " +catalog[x].discount;
    var number = '<input type="number" id="input-small" name="quantity" min="1" max="'+catalog[x].amountStock+'" value="1">';
    var button = '<button type="button" onclick="addToCart('+x+')">Add to cart</button>';
    container.innerHTML += " &nbsp; "+number+" &nbsp; "+button+" <br/><br/>";

  }
}

/******************************************************************************/
/*REFRENCE: http://stackoverflow.com/questions/143847/best-way-to-find-an-item-in-a-javascript-array*/
function include(arr,obj) {
  return (arr.indexOf(obj) != -1);
}

function addToCart(id){

  //logic: check if item is in cart already
  if( include(cart,catalog[id]) == false ){
    cart.push(catalog[id]);
  }

  var i = cart.length-1;
  //decrement amount in stock (and check if we have enoughs)
  var qtdNumber = document.getElementById('input-small').value;
  cart[i].amountStock -= qtdNumber;
  var container = document.getElementById('input-small');
  container.setAttribute("MAX",cart[i].amountStock);
  if( cart[i].amountStock < 0 ){
    alert("I'm sorry you can't buy any more of \""+catalog[id].name+"\" we don't have that many in stock");
    return;
  }else{
    //if it's a valid purchase then we increase the product quantity
    cart[i].quantity++;
    console.log("added to cart product id "+cart[cart.length-1].id+" ammount in stock is "+cart[cart.length-1].amountStock+" and quantity is "+cart[cart.length-1].quantity);

    //viewCart();
    var cont = document.getElementById('viewCartbutt');
    cont.style.visibility = "visible";
  }

}

/******************************************************************************/


function viewCart(){
  var ele = document.getElementById('viewcartDiv');

var product_price = 0;
  for(x in cart){
    var percent = (cart[x].discount / 100);
    product_price =  parseInt(percent * cart[x].price);
    product_price = parseInt( product_price * cart[x].quantity);
    Tprice += product_price;

    if(!ele){
      ele.innerHTML = '<li>'+cart[x].name+' | '+cart[x].quantity+' | '+product_price+' </li>';
      ele.style.visibility = 'visible';
    }else{
      ele.innerHTML += '<li>'+cart[x].name+' | '+cart[x].quantity+' | '+product_price+' </li>';
      ele.style.visibility = 'visible';
    }
  }
  var ele = document.getElementById('buybutt');
  ele.style.visibility = "visible";
}

/******************************************************************************/


function buy(){
  var sendJSON = JSON.stringify(cart);
  //console.log (sendJSON);
  var r = confirm("Are you sure you want to buy!\nTotal Price= "+Tprice);
  if (r == true) {
    loadXMLDoc(sendJSON);
  } else {
    return;
  }
}

function loadXMLDoc(sendJSON)
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
            alert(xmlhttp.responseText);
          }
      }
      xmlhttp.open("GET","registerSale.php",true);
      //xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xmlhttp.send(sendJSON);
}

/******************************************************************************/

/******************************************************************************/



/*
* programming notes:
*http://jsoneditoronline.org/#
* { "User" : { "Name"  : "John Doe", "cash" : 700 },
"Catalog"  : [
{ "Name"  : "Album1", "price" : 100, "Discount" : 10 },
{ "Name"  : "Album2", "price" : 130, "Discount" : 20 },
{ "Name"  : "Album3", "price" : 130, "Discount" : 20 },
{ "Name"  : "Album4", "price" : 130, "Discount" : 20 }
]
}
* */
