var xmlHttpObj;
var doctext;



/******************************************************************************/


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
            var json = JSON.parse(doctext);
            createCookie("username",json.User.Name, 1);
            compileCatalog(json);
            var container = document.getElementById('loginWidget');
            container.innerHTML="welcome "+json.User.Name+"!";
            container.innerHTML+="<hr>";
            container.innerHTML+="<button id='logout' value='logout' onclick='logout()'>"
            /*container.innerHTML+='<br/><input type="button" value="view cart" onclick="viewCart()">';
            container.innerHTML+='<br/><div id="CartSpace" style="visibility: hidden"></div>';*/
            printCatalog(json, json.User.Name);
        }

    }
}

/******************************************************************************/
/*http://stackoverflow.com/questions/6561687/how-can-i-set-a-cookie-to-expire-after-x-days-with-this-code-i-have*/
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

/******************************************************************************/

function logout(){
  //coockie.destroy();
  //resto da logica
}
