var xmlHttpObj;
var doctext;

var cart = new Array();
var Tprice;

var username;
var cash;

function preValidateLogin(){

  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  if(username != '' && password != ''){
    MakeXMLHTTPCall(username,password);
  }else {
      var ele = document.getElementById('errorlist');
      ele.innerHTML = 'you need to fill user name and password.';
      ele.style.visibility = 'visible';
  }
}

function CreateXmlHttpRequestObject( )
{
  // detecção do browser simplificada
  // e sem tratamento de excepções
  xmlHttpObj=null;
  if (window.XMLHttpRequest) // IE 7 e Firefox
    {
      xmlHttpObj=new XMLHttpRequest()

    }
    else if (window.ActiveXObject) // IE 5 e 6
      {
        xmlHttpObj=new ActiveXObject("Microsoft.XMLHTTP")
      }
      return xmlHttpObj;
};

function MakeXMLHTTPCall(username,password)
{
      xmlHttpObj = CreateXmlHttpRequestObject();

      if (xmlHttpObj)
        {
          // Definição do URL para efectuar pedido HTTP - método GET
          xmlHttpObj.open("GET","login.php"+'?username='+username+'&password='+password ,true);

          // Registo do EventHandler
          xmlHttpObj.onreadystatechange = stateHandler;
          xmlHttpObj.send(null);
        }
}

function stateHandler()
{
    if ( xmlHttpObj.readyState == 4 && xmlHttpObj.status == 200) // resposta do servidor completa
    {
        // propriedade responseText que devolve a resposta do servidor
        doctext = xmlHttpObj.responseText;
        if(doctext == 'login error'){
            var ele = document.getElementById('errorlist');
            ele.innerHTML = 'User name and password do not match or we can\t reach the server.';
            ele.style.visibility = 'visible';
        }else {
            var json = JSON.parse(doctext);
            var container = document.getElementById('loginWidget');
            container.innerHTML="welcome "+json.User.Name+"!";
            container.innerHTML+="<hr>";
            container.innerHTML+="you have: <p id='cashCont'>"+json.User.cash+"€</p> <hr>";
            container.innerHTML+='<br/><input type="button" value="view cart" onclick="viewCart()">';
            container.innerHTML+='<br/><div id="CartSpace" style="visibility: hidden"></div>';
            username = json.User.Name;
            cash = json.User.cash;
            printCatalog(json);
        }

    }
}

function printCatalog(json){

    var container = document.getElementById('CatalogDisplay');
    container.innerHTML = "";
    for(var x=0; x<json.Catalog.length; x++){
        container.innerHTML += json.Catalog[x].Name+" | "+json.Catalog[x].price;
        container.innerHTML += " &nbsp; ";
        var n = json.Catalog[x].Name;
        var p = json.Catalog[x].price;
        //var stringer =  '<input type="button" value="buy" onclick="addToCart("'+n+'",'+p+')">';
        //var stringer = '<div id="buyButtCont">buy this shit</div>';
        //container.innerHTML += stringer;
        //container.innerHTML += "<br/>";

        var link = document.createElement('a');
        var method = "addToCart("+'"'+n+'"'+","+'"'+p+'"'+")";
        var linkText = document.createTextNode('add to cart');
        
        link.appendChild(linkText);
        container.appendChild(link);
    }
}

function addToCart(product, price){
alert(product+price);
    cart.push(product);
    Tprice+=price;
    var ele = document.getElementById('cashCont');
    ele.innerHTML = cash-price;
    if(cash < 0) {alert("you're broke!");}

}

function viewCart(){
    var ele = document.getElementById('CartSpace');

    for(x in cart){
        ele.innerHTML+= cart[x] + '<br/>'
    }
    ele.innerHTML+='<input type="button" value="buy(view result on console)" onclick="buy()">';
    ele.style.visibility = 'visible';
}

function buy(){
    var sendJSON = JSON.stringify(cart);
    console.log = sendJSON;

    /*
    * 1. send this data to the server as new ajax request
    * 2. decrease quantity in albums and make sure everything was ok
    * 3. (optionally) return the user cash amount and compare to make sure the math was right
    * */
}


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
