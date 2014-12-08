<?php
    // informacoes que precisamos de reter:
    global $trackName;       //(dado)
    global $trackArtist;     //(dado)
        
    global $albumImg;
    global $topAlbum1;
    global $topAlbum2;
    global $topAlbum3;
    global $artTopTrack;
    global $artImg;
    global $albumName;
    
    $trackName= $_REQUEST['track'];
    $trackArtist= $_REQUEST['artist'];
    
    include('DAL.php');
    $dal = new DAL();
    
    $trackInfoDOM= new DOMDocument('1.0', 'ISO-8859-1'); 
    $url = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=376b1cbc2794596f36e176f36784577f&artist=$trackArtist&track=$trackName";
    $trackInfoDOM->load($url); //get ficheiro XML do artista

    $dal->insertTrackRequest($url);
    $trackInfoDOM->save("xml/TrackInfo.xml"); //guardar ficheiro

    $tracks='xml/TrackInfo.xml'; //carregar ficheiro XML
    $trackInfo=file_get_contents($tracks); //buscar conteudo do XML
    
    $trackObj=new simplexmlelement($trackInfo); //cria um objecto a partir do XML


    
    $albumName = $trackObj->track->album->title;
    $artist = $trackObj->track->artist->name;
    

    //____________________________ $albumImg ___________________________________

    $albMbid= $trackObj->track->album->mbid;
    

    $urlJson = "http://coverartarchive.org/release/$albMbid?application/json";

    $content = @file_get_contents($urlJson);
    $json = json_decode($content,true);
    
    $albumImg=$json['images'][0]['thumbnails']['small'];
    
    if($albumImg===NULL){ //album cover alternative, using iTunes
        $encAlbName=urlencode($albumName);
        $urlJson = "https://itunes.apple.com/search?term=$encAlbName";

        $content = @file_get_contents($urlJson);

        $json = json_decode($content,true);
        $albumImg = @$json['results'][0]['artworkUrl100'];
        if($albumImg == NULL) 
            $albumImg = "images/noimage.jpg";
    }

    //__________________________________________________________________________



    //____________________________ $topAlbum(1)(2)(3) __________________________
    $ArtistAlbumDOM= new DOMDocument('1.0', 'ISO-8859-1');
    $ArtistAlbumDOM->load("http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=$trackArtist&api_key=376b1cbc2794596f36e176f36784577f"); //get ficheiro XML do artista
    $ArtistAlbumDOM->save("xml/TopAlbumInfo.xml"); //guardar ficheiro

    $artAlbum='xml/TopAlbumInfo.xml'; //carregar ficheiro XML
    $artAlbumInfo=file_get_contents($artAlbum); //buscar conteudo do XML
    
    $artAlbumObj=new simplexmlelement($artAlbumInfo); //cria um objecto a partir do XML
    $i=0;
    
    foreach($artAlbumObj->topalbums->album as $album){
        $topAlbName= $album->name;
        $i++;
        if($i == 1) $topAlbum1 = $topAlbName;
        if($i == 2) $topAlbum2 = $topAlbName;
        if($i == 3) $topAlbum3 = $topAlbName;
        if($i==3){
            break;
        }
    }
    //__________________________________________________________________________

    //____________________________ $artTopTrack ________________________________
    $ArtistInfoDOM= new DOMDocument('1.0', 'ISO-8859-1');
    $ArtistInfoDOM->load("http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=$trackArtist&api_key=376b1cbc2794596f36e176f36784577f"); //get ficheiro XML do artista
    $ArtistInfoDOM->save("xml/ArtistTopTracksInfo.xml"); //guardar ficheiro

    $artTrTopInfo='xml/ArtistTopTracksInfo.xml'; //carregar ficheiro XML
    $artTopTrXML=file_get_contents($artTrTopInfo); //buscar conteudo do XML

    $artTopInfoObj=new simplexmlelement($artTopTrXML); //cria um objecto a partir do XML
    $artTopTrack= $artTopInfoObj->toptracks->track->name;

    //__________________________________________________________________________


    //____________________________ $artImg ________________________________
    $ArtistInfoDOM= new DOMDocument('1.0', 'ISO-8859-1');
    $ArtistInfoDOM->load("http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$trackArtist&api_key=376b1cbc2794596f36e176f36784577f"); //get ficheiro XML do artista
    $ArtistInfoDOM->save("xml/ArtistInfo.xml"); //guardar ficheiro

     $artistInfo='xml/ArtistInfo.xml'; //carregar ficheiro XML
     $artInfo=file_get_contents($artistInfo); //buscar conteudo do XML

    $artInfoObj=new simplexmlelement($artInfo); //cria um objecto a partir do XML
    $artImg= $artInfoObj->artist->image[2];

    //__________________________________________________________________________

    ?>
        <!--codigo html a ser apresentado-->

            <span id="tooltip-span">
            <!--material que vai mostrar na tooltip-->
                <table class="tooltipTable" >
                    <tr><td>Music: <?php echo $trackName ?></td></tr>
                    <tr>
                        <th>Artist: <?php echo $trackArtist; ?></th>
                        <th></th>
                        <th><img src="<?php echo $artImg; ?>" width="100px"></th>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Top Albuns</td>
                        <td rowspan="4"></td>
                        <td>Album: <?php echo $albumName; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $topAlbum1; ?></td>
                        <td rowspan="3"><img src="<?php echo $albumImg; ?>" width="100px"></td>
                    </tr>
                    <tr>
                        <td><?php echo $topAlbum2; ?></td>
                    </tr>
                        <tr>
                        <td ><?php echo $topAlbum3; ?></td>
                    </tr>
                </table>
            <!---------------------------------------->
            </span>
       </div>
    