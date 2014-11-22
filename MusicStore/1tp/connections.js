///////////////////////////////////////////// HTTP REQUEST ////////////////////////////////////////
// Váriavel para o objecto XMLxmlHttpObj
var xmlHttpObj;

function CreateXmlxmlHttpObjObject()
{ 
    xmlHttpObj = null;

    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        xmlHttpObj = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
        try {
            xmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    return xmlHttpObj;
}

///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////// TAGS ////////////////////////////////////////////////

function MakeXMLHTTPCallTags(artist, nTrack)
{     
    xmlHttpObj = CreateXmlxmlHttpObjObject();

    if (xmlHttpObj)
    {
        document.getElementById("artistNameDiv").innerHTML = artist;
        
        var loading = "<div align=\"center\"><img src=\"images/loading.gif\" loop=infinite alt=\"Loading Top Tracks\" width=\"20%\"></div>";
        document.getElementById("tagTableDiv").innerHTML = loading;
        
        // Definição do URL para efectuar pedido HTTP - método GET
        xmlHttpObj.open("GET", "ArtistTopTags.php" + "?artist=" + artist + "&nTracks=" + nTrack, true);
        // Registo do EventHandler
        xmlHttpObj.onreadystatechange = stateHandlerTags;
        xmlHttpObj.send(null);
    }
}

function stateHandlerTags()
{
    if ( xmlHttpObj.readyState == 4) {
        if (xmlHttpObj.status === 200) { // resposta do servidor completa
            // FAZER INNERHTML NO DIV
            document.getElementById("tagTableDiv").innerHTML = xmlHttpObj.responseText;
        } else {
            alert('There was a problem with the request.');
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////// Tracks ////////////////////////////////////////////// 

function MakeXMLHTTPCallTracks(tagName, nTrack){

    xmlHttpObj = CreateXmlxmlHttpObjObject();

    if(xmlHttpObj)
    {
        document.getElementById("tagNameDiv").innerHTML = tagName;
        
        var loading = "<div align=\"center\"><img src=\"images/loading.gif\" loop=infinite alt=\"Loading Top Tracks\" width=\"20%\"></div>";
        document.getElementById("trackTableDiv").innerHTML = loading;
        
        // Definição do URL para efectuar pedido HTTP - método GET
        xmlHttpObj.open('GET', "TagTopTracks.php" + "?q=" + tagName + "&s=" + nTrack, true);
        // Registo do EventHandler
        xmlHttpObj.onreadystatechange = stateHandlerTracks;
        xmlHttpObj.send(null);
    }
}


function stateHandlerTracks() {
    var tags = "";

    if (xmlHttpObj.readyState === 4) {
        if (xmlHttpObj.status === 200) {// resposta do servidor completa
            var textDoc = xmlHttpObj.responseText;
            //alert(textDoc);
            document.getElementById("trackTableDiv").innerHTML = textDoc;
        } else {
            alert('There was a problem with the request.');
        }
    }
}

//_____________________________________________________________
function showTrackInfo(trackName, trackArtist){
 
    xmlHttpObj = CreateXmlxmlHttpObjObject();
    
    loadToolTipSpace();
    
    var loading = "<div align=\"center\"><img src=\"images/loading.gif\" loop=infinite alt=\"Loading Top Tracks\" width=\"20%\"></div>";
    document.getElementById("tooltipDiv").innerHTML = loading;
    
    xmlHttpObj.onreadystatechange = stateHandlerTrackInfo;
    xmlHttpObj.open('GET', "ShowTrackInfo.php" + "?track=" + trackName + "&artist="+ trackArtist, true);
    xmlHttpObj.send(null);
}


    function stateHandlerTrackInfo() {
        var tags = "";
        if (xmlHttpObj.readyState === 4) {
            if (xmlHttpObj.status === 200) {
                
                var textDoc = xmlHttpObj.responseText;
                // como sera para criar a tooltip dinamicamente...
                document.getElementById("tooltipDiv").innerHTML = textDoc;
            } else {
                alert('There was a problem with the request.');
            }
        }
}
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////// EVENTS //////////////////////////////////////////////
function MakeXMLHTTPCallEvents(location, radius, page)
{     
    xmlHttpObj = CreateXmlxmlHttpObjObject();

    if (xmlHttpObj)
    {
        var loading = "<div align=\"center\"><img src=\"images/loading.gif\" loop=infinite alt=\"Loading Top Tracks\" width=\"20%\"></div>";
        
        document.getElementById("locationNameDiv").innerHTML = "Eventos no " + location;
        document.getElementById("EventsTableDiv").innerHTML = loading;
        // Definição do URL para efectuar pedido HTTP - método GET
        xmlHttpObj.open("GET", "Events.php" + "?location=" + location + "&radius=" + radius + "&page=" + page, true);
        // Registo do EventHandler
        xmlHttpObj.onreadystatechange = stateHandlerEvents;
        xmlHttpObj.send(null);
    }
}

function stateHandlerEvents()
{
    
    if ( xmlHttpObj.readyState == 4 && xmlHttpObj.status == 200) // resposta do servidor completa
    {
        // FAZER INNERHTML NO DIV
        document.getElementById("EventsTableDiv").innerHTML = xmlHttpObj.responseText;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////// EVENTOS /////////////////////////////////////////////
function buscarEventos(location, radius){

    xmlHttpObj = CreateXmlxmlHttpObjObject();

    if (!xmlHttpObj) {
        alert('Giving up, Cannot create an XMLHTTP instance');
        return false;
    }

    var location = document.getElementById("EvLocation").value;
    xmlHttpObj.onreadystatechange = eventsReadyState;
    xmlHttpObj.open('GET', "EventsLocal.php" + "?location=" + location + "&radius=" + radius, true);
    xmlHttpObj.send(null);
}


function eventsReadyState() {
    var tags = "";
    if (xmlHttpObj.readyState < 4) {
        if (xmlHttpObj.status === 200) {
            var loading = "<img src=\"loading.gif\" loop=infinite alt=\"Loading Top Tracks\" width=\"20%\">";
            document.getElementById("bottomInnerDiv").innerHTML = loading;
        }
    }

    if (xmlHttpObj.readyState === 4) {
        if (xmlHttpObj.status === 200) {
            var response = xmlHttpObj.responseText;
            var textDoc = JSON.parse(response);

            var markers= new Array();

            textDoc.forEach(function(geo,index){   

               var lat=geo.lat;
               var long=geo.long;
               var name=geo.name;
               var mark= [name,lat,long];
               markers.push(mark);

            });
            var infowindow = new google.maps.InfoWindow(), marker, i;
            for (i = 0; i < markers.length; i++) { 

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(markers[i][1], markers[i][2]),
                    map: map
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(markers[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }   

            document.getElementById("bottomInnerDiv").innerHTML = textDoc;
        } else {
            alert('There was a problem with the request.');
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////