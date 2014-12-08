var catalog = new Array();
var cart = new Array();
var Tprice;

var username;

function compileCatalog(json, user){
  username = user;

  for(var x=0; x<json.length; x++){
    catalog.push( new product(json[x].AlbumID, json[x].AlbumName, json[x].AlbumArtist, json[x].AmountStock, json[x].UnitPrice, json[x].Discount) );
  }

  //printCatalog();
}

function printCatalog(){

  var container = document.getElementById('CatalogDisplay');
  container.innerHTML = "";
  for(var x=0; x<Catalog.length; x++){
    container.innerHTML += Catalog[x].Name+" | "+Catalog[x].price + " | " +Catalog[x].discount;
    container.innerHTML += " &nbsp; ";

    //well take it from here when everything displays properly
    //var n = json.Catalog[x].Name;
    //var p = json.Catalog[x].price;
    //var stringer =  '<input type="button" value="buy" onclick="addToCart("'+n+'",'+p+')">';
    //var stringer = '<div id="buyButtCont">buy this shit</div>';
    //container.innerHTML += stringer;
    //container.innerHTML += "<br/>";

    //var link = document.createElement('a');
    //var method = "addToCart("+'"'+n+'"'+","+'"'+p+'"'+")";
    //var linkText = document.createTextNode('add to cart');

    //link.appendChild(linkText);
    //container.appendChild(link);
  }
}

/******************************************************************************/

function addToCart(product, price){
  alert(product+price);
  cart.push(product);
  Tprice+=price;
  var ele = document.getElementById('cashCont');
  ele.innerHTML = cash-price;
  if(cash < 0) {alert("you're broke!");}

  }

  /******************************************************************************/


function viewCart(){
  var ele = document.getElementById('CartSpace');

  for(x in cart){
    ele.innerHTML+= cart[x] + '<br/>'
  }
  ele.innerHTML+='<input type="button" value="buy(view result on console)" onclick="buy()">';
  ele.style.visibility = 'visible';
}

/******************************************************************************/


function buy(){
  var sendJSON = JSON.stringify(cart);
  console.log = sendJSON;

  /*
  * 1. send this data to the server as new ajax request
  * 2. decrease quantity in albums and make sure everything was ok
  * 3. (optionally) return the user cash amount and compare to make sure the math was right
  * */
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
