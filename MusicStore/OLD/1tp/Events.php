<?php
    // PARA DESCOMENTAR
    global $location;
    global $radius;
    global $page;

    $location = $_GET['location'];
    $radius = $_GET['radius'];
    $page = $_GET['page'];
    
    $location = str_replace(' ', '%20', $location);

    if($page == "") $page="1";

    include('DAL.php');
    $dal = new DAL();

    $limit = "3";

    //$eventsDOM= new DOMDocument('1.0', 'ISO-8859-1'); 
    $array_geo = array();
    $url = "http://ws.audioscrobbler.com/2.0/?method=geo.getevents&location=$location&radius=$radius&page=$page&limit=$limit&api_key=376b1cbc2794596f36e176f36784577f&format=json";
    $eventsJSON=file_get_contents($url);
    $dal->insertEventRequest($url);

    $location = str_replace('%20', ' ', $location);

    fopen("json/events.json", "w");

    file_put_contents('json/events.json', $eventsJSON);

    $jsonArray = json_decode($eventsJSON, true);
    
    if(@$jsonArray["error"])
        echo "<div align=\"center\">Não foi possivel encontrar eventos</div>";
    else
    {
        $eventos=$jsonArray["events"]["event"];

        $paginas = $jsonArray["events"]["@attr"]["totalPages"];

        $totalResults = $jsonArray["events"]["@attr"]["total"];

        foreach($eventos as $key=>$evento){
            $name= $evento["title"];
            $lat= $evento["venue"]["location"]["geo:point"]["geo:lat"];
            $long= $evento["venue"]["location"]["geo:point"]["geo:long"];
            array_push($array_geo, array('name'=>$name,'lat'=>$lat, 'long' => $long));
        }

        //echo json_encode($array_geo);
        echo "<div id=\"eventsTableDiv\" class=\"eventsTableContainer\">";
        $i = 0;
        foreach($eventos as $key=>$evento){
            $i++;
            $name= $evento["title"];
            $startDate= $evento["startDate"];
            $lat= $evento["venue"]["location"]["geo:point"]["geo:lat"];
            $long= $evento["venue"]["location"]["geo:point"]["geo:long"];
            // HTML dos resultados
            $res = "<table id=\"eventsTable\" class=\"resultsTable\">
                <tr onclick='showMaps(\"$lat\",\"$long\");'>
                    <td>
                        $name
                    </td>
                    <td>
                        $startDate
                    </td>
                </tr>
            </table>";
            echo $res;
        }
        echo "</div>";


        $pag = 0;

        // CODIGO HTML PARA 
        $res = "<div id=\"pageDiv\" align=\"center\" class=\"pagesContainer\">
                    <table>";
        for ($pag=1; $pag <= $paginas; $pag++) {

            $function = "MakeXMLHTTPCallEvents(\"$location\",\"$radius\",\"$pag\");";
            $res = $res."<tr>";
            
            if($pag == $page)
                $res = $res."<button style=\"font-style: bold\" onclick='$function'> $pag </button>";
            else
                $res = $res."<button onclick='$function'> $pag </button>";
            
            $res = $res."</tr>";
        }
        $res = $res."</table></div></div>";

        echo $res;
    }
?>



 
