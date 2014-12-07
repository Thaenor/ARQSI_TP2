var xmlHttpObj;
var doctext;

function openRegister(){

    var cont = document.getElementById('RegisterWidget');
    cont.style.visibility = "visible";
}

function registationValidator(){

    var username = document.getElementById('regUsername').value;
    var password = document.getElementById('regPassword').value;
    var rePassword = document.getElementById('regPassword2').value;

    if(username != '' && password != '' && rePassword != '' && password == rePassword){
        MakeRegisterXMLHTTPCall(username,password,rePassword);
    }else {
        var ele = document.getElementById('errorlist');
        ele.innerHTML = 'we couldn\'t find the server, please review your user name and password while we try to figure where he went.';
        ele.style.visibility = 'visible';
    }
}


/******************************************************************************/

 function CreateRegisterXmlHttpRequestObject( )
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

function MakeRegisterXMLHTTPCall(username,password, Repassword)
{
    xmlHttpObj = CreateRegisterXmlHttpRequestObject();

    if (xmlHttpObj)
    {
        // Definição do URL para efectuar pedido HTTP - método GET
        xmlHttpObj.open("GET","Register.php"+'?username='+username+'&password='+password+'&REpassword='+Repassword,true);

        // Registo do EventHandler
        xmlHttpObj.onreadystatechange = RegisterstateHandler();
        xmlHttpObj.send(null);
    }
}

function RegisterstateHandler()
{
    if ( xmlHttpObj.readyState == 4 && xmlHttpObj.status == 200) // resposta do servidor completa
    {
        // propriedade responseText que devolve a resposta do servidor
        doctext = xmlHttpObj.responseText;
        console.log(xmlHttpObj.responseText);
        alert(xmlHttpObj.responseText);
        console.log(doctext);
        if(doctext!=''){alert("yey"); console.log('success!!!');}
    }
}