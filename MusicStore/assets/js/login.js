"use strict";
var xmlHttpObj;
var doctext;

var username;
var password;
/******************************************************************************/


function preValidateLogin(){

  username = document.getElementById('username').value;
  password = document.getElementById('password').value;

  if( !username  || !password ){
    var ele = document.getElementById('errorlist');
    ele.innerHTML = 'you need to fill user name and password.';
    ele.style.visibility = 'visible';
  }else {
    MakeXMLHTTPCall(username,password);

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
        if(doctext == 'error'){
            var ele = document.getElementById('errorlist');
            ele.innerHTML = 'User name and password do not match or we can\t reach the server.';
            eraseCookie('username');
            eraseCookie('login');
            alert('login error');
            ele.style.visibility = 'visible';
        }else {

            //a is for admin
            if(doctext == 'a'){
              //display SOAP order
              createCookie("username",username, 1);
              createCookie("password",password, 1);
              showWelcomeDialog();
              AjaxSoapOrder();
            }else{
              //it's a client!
              createCookie("username",username, 1);
              createCookie("password",password, 1);
              showWelcomeDialog();

              var json = JSON.parse(doctext);
              compileCatalog(json, username);
            }
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
  var cont = document.getElementById('RegisterWidget');
  cont.style.visibility = "visible";
}

function refresh()
{
  username = readCookie('username');
  password = readCookie('password');

  if( !username || !password ){
    logout();

  }else {
    //alert(readCookie('username')+readCookie('password'))
    MakeXMLHTTPCall(readCookie('username'),readCookie('password'));
  }
}

function showWelcomeDialog(){
  var container = document.getElementById('welcome');
  container.innerHTML="welcome "+username+"!";
  var cont = document.getElementById('loginform');
  cont.style.visibility="hidden";
  var ele = document.getElementById('logoutbutt');
  ele.style.visibility = "visible";
}
