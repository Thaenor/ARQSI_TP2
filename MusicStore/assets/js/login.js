"use strict";
var xmlHttpObj;
var doctext;

var username;
var password;
/******************************************************************************/


function preValidateLogin(){

  username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  if(username != '' && password != ''){
    createCookie("username",username, 1);
    createCookie("password",password, 1);
    MakeXMLHTTPCall(username,password);
  }else {
      var ele = document.getElementById('errorlist');
      ele.innerHTML = 'you need to fill user name and password.';
      ele.style.visibility = 'visible';
  }
}

/******************************************************************************/


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

/******************************************************************************/


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

/******************************************************************************/


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

            var container = document.getElementById('welcome');
            container.innerHTML="welcome "+username+"!";
            container.style.visibility='visibile';
            var cont = document.getElementById('loginform');
            cont.style.visibility="hidden";
            var ele = document.getElementById('logoutbutt');
            ele.style.visibility = "visible";
            var ele = document.getElementById('registerform');
            ele.style.visibility="hidden";

            //a is for admin
            if(doctext == 'a'){
              alert('here');//display SOAP order
            }else if(doctext == 'error'){
              //display error message
            }else{

              var json = JSON.parse(doctext);
              compileCatalog(json, username);
            }

            /*container.innerHTML+='<br/><input type="button" value="view cart" onclick="viewCart()">';
            container.innerHTML+='<br/><div id="CartSpace" style="visibility: hidden"></div>';*/
            //printCatalog(json, json.User.Name);
        }
    }
}

/******************************************************************************/
/*http://stackoverflow.com/questions/6561687/how-can-i-set-a-cookie-to-expire-after-x-days-with-this-code-i-have*/
/*http://www.quirksmode.org/js/cookies.html*/
function createCookie(name, value, days) {
  var date, expires;
  if (days) {
    date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    expires = "; expires="+date.toGMTString();
  } else {
    expires = "";
  }
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

/******************************************************************************/

function logout(){
  eraseCookie('username');
  var ele = document.getElementById('logoutbutt');
  ele.style.visibility = "hidden";
  var cont = document.getElementById('loginform');
  cont.style.visibility="visible";
  var cont = document.getElementById('welcome');
  cont.style.visibility="hidden";
}

function refresh()
{
  username = readCookie('username');
  password = readCookie('password');

  if( (username != null) && (password =! null) ){
    username = readCookie('username');
    password = readCookie('password');

    var container = document.getElementById('welcome');
    container.innerHTML="welcome "+username+"!";
    var cont = document.getElementById('loginform');
    cont.style.visibility="hidden";
    var ele = document.getElementById('logoutbutt');
    ele.style.visibility = "visible";

    MakeXMLHTTPCall(readCookie('username'),readCookie('password'));
  }else {logout()}
}
