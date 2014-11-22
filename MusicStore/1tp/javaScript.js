function verificaTagsForm() {
    
    var defaultArtist = "Marillion";
    var defaultNTracks = 10;
    
    var artist = document.getElementById("ArtTopTag").value;
    var nTracks = document.getElementById("nTracks").value;
    var res = "";

    if(artist == ''){
        res += "You didn't insert an valid name for the artist.\n";
        res += "Default will be " + defaultArtist + "\n";
        document.getElementById("ArtTopTag").value = defaultArtist;
        artist = defaultArtist;
    }
    if(nTracks == ''){
        res += "\nYou didn't insert an valid number of tracks to be shown.\n";
        res += "Default will be " + defaultNTracks + "\n";
        document.getElementById("nTracks").value = defaultNTracks;
        nTracks = defaultNTracks;
    }
    if(res != "")
        alert(res);
    
    MakeXMLHTTPCallTags(artist, nTracks);
}

function verificaEventsForm() {
    
    var defaultLocation = "Porto";
    var defaultRadius = 5;
    
    var location = document.getElementById("EventLocation").value;
    var radius = document.getElementById("radius").value;
    var res = "";

    if(location == ''){
        res = res + "You didn't insert an valid location.\n";
        res = res + "Default will be " + defaultLocation + "\n";
        document.getElementById("EventLocation").value = defaultLocation;
        location = defaultLocation;
    }
    if(radius ==  ''){
        res = res + "\nYou didn't insert an valid radius.\n";
        res = res + "Default will be " + defaultRadius + "\n";
        document.getElementById("radius").value = defaultRadius;
        radius = defaultRadius;
    }
    if(res != "")
        alert(res);

    MakeXMLHTTPCallEvents(location, radius, "1");
}

// Code for the tooltip to follow the mouse 
function tooltipFun() {
    var tooltips = document.querySelectorAll('.tooltip span');

    window.onmousemove = function (e) {
        var x = (e.clientX + 20) + 'px',
            y = (e.clientY + 20) + 'px';
        for (var i = 0; i < tooltips.length; i++) {
            tooltips[i].style.top = y;
            tooltips[i].style.left = x;
        }
    };
}

////////////////////// Codigo dos mapas (POR CORRIGIR!) //////////////////////

var map;

function showMaps(lat, long) {
    
    if(lat == null || long == null) {
        lat = 41.15;
        long = -8.611111;
        
        function initialize() {
        
            var mapCanvas = document.getElementById('bottomInnerDiv');
            var myCenter=new google.maps.LatLng(lat,long);
            var mapOptions = {

                center: new google.maps.LatLng(lat, long),
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(mapCanvas, mapOptions);
            map.setTilt(45);
        }
    } 
    else 
    {
        var myCenter=new google.maps.LatLng(lat, long);

        function initialize()
        {
            var mapProp = {
              center:myCenter,
              zoom:12,
              mapTypeId:google.maps.MapTypeId.ROADMAP
              };

            var map=new google.maps.Map(document.getElementById("bottomInnerDiv"),mapProp);

            var marker=new google.maps.Marker({
              position:myCenter,
              });

            marker.setMap(map);
        }
    
    }
initialize();
google.maps.event.addDomListener(window, 'load', initialize);
}

//////////////////////////////////////////////////////////////

//////////////////////Codigo dos butoes////////////////////////
function graytoptagsButton() {
    
    var resA = "<a id=\"eventsButton\" class=\"formButton\"" 
    + " href=\"#\" align=\"left\">Events</a>";
    
    var resD = "<a id=\"toptagsButton\" class=\"formButtonDisabled\"" 
    + " href=\"#\" align=\"left\" >Top tags</a>";
    
    document.getElementById("eventsDiv").innerHTML = resA;
    document.getElementById("toptagsDiv").innerHTML = resD;
}

function grayeventsButton() {
    
    var resA = "<a id=\"toptagsButton\" class=\"formButton\"" 
    + " href=\"#\" align=\"left\">Top tags</a>";
    
    var resD = "<a id=\"eventsButton\" class=\"formButtonDisabled\"" 
    + " href=\"#\" align=\"left\" >Events</a>";
    
    document.getElementById("toptagsDiv").innerHTML = resA;
    document.getElementById("eventsDiv").innerHTML = resD;
}

////////////////////////// Codigo dos botoes superiores ////////////////////////////////////

function showEvents() {
    unloadToolTipSpace();
    showEventsForm();
    
    var res = "";
    res = res + "<div id=\"locationNameDiv\" align=\"center\">Evento</div>";
    res = res + "<div id=\"EventsTableDiv\" class=\"tableContainer\">";
    res = res + "<div align=\"center\">tabela de resultados de eventos</div>";
    res = res + "</div>";
    document.getElementById("topInnerDiv").innerHTML = res;
    
    showMaps(null,null);
}

function showEventsForm() {
    var res = "";
    res = res + "<div>";
    res = res + "   Insert a location:";
    res = res + "   <input type=\"text\" id=\"EventLocation\" name=\"location\"";
    res = res + "           placeholder=\"Insert an location\"";
    res = res + "           accesskey=\"verificaFormulario();\"";
    res = res + "           autofocus>";
    res = res + "   </input>";
    res = res + "</div>";
    res = res + "<div>";
    res = res + "   Radius(Kilometers):";
    res = res + "   <input type=\"number\" step=\"any\" id=\"radius\" name=\"radius\"";
    res = res + "           onfocus=\"this.value='';\" autocomplete=\"on\" min=\"0\">";
    res = res + "</div>";
    res = res + "<div>";
    res = res + "   <input class=\"submitButton\" type=\"button\" value=\"Search\" onclick=\"verificaEventsForm();\"/>";
    res = res + "</div>";
    document.getElementById("form").innerHTML = res;
}

function showTags() {
    showTagsForm();
    
    var res = "";
    res = res + "<div id=\"artistNameDiv\" align=\"center\">artist</div>";
    res = res + "<div id=\"tagTableDiv\" class=\"tableContainer\">";
    res = res + "<div align=\"center\">tabela de resultados das tags</div>";
    res = res + "</div>";
    document.getElementById("topInnerDiv").innerHTML = res;

    res = "";
    res = res + "<div id=\"tagNameDiv\" align=\"center\">tag</div>";
    res = res + "<div id=\"trackTableDiv\" class=\"tableContainer\">";
    res = res + "<div align=\"center\">tabela de resultados das tracks</div>";
    res = res + "</div>";
    document.getElementById("bottomInnerDiv").innerHTML = res;
}

function showTagsForm() {
    var res = "";
    res = res + "<div>";
    res = res + "   Insert an Artist:";
    res = res + "   <input type=\"text\" id=\"ArtTopTag\" name=\"artTop\" ";
    res = res + "       placeholder=\"Insert an Artist\" ";
    res = res + "       accesskey=\"verificaFormulario();\" ";
    res = res + "       autofocus></input>";
    res = res + "</div>";
    res = res + "<div>";
    res = res + "   Insert Number of Tracks:";
    res = res + "   <input type=\"number\" id=\"nTracks\" name=\"nTracks\" ";
    res = res + "       onfocus=\"this.value='';\" autocomplete=\"on\" min=\"1\"";
    res = res + "       max=\"50\">";
    res = res + "</div>";
    res = res + "<div>";
    res = res + "   <input  class=\"submitButton\" type=\"button\" value=\"Search\" onclick=\"verificaTagsForm();\"/>";
    res = res + "</div>";
    document.getElementById("form").innerHTML = res;

}

function loadToolTipSpace() {
    res = "<div id=\"tooltipDiv\" class=\"tooltipDiv\">";
    document.getElementById("tooltipEx").innerHTML = res;
}

function unloadToolTipSpace() {
    document.getElementById("tooltipEx").innerHTML = "";
}
