<?php
    $tag=$_REQUEST['q'];
    $nTrack=$_REQUEST['s'];
    include('DAL.php');
    $dal = new DAL();
    

    $topTracksDOM= new DOMDocument('1.0', 'ISO-8859-1');
    $url = "http://ws.audioscrobbler.com/2.0/?method=tag.gettoptracks&tag=$tag&api_key=376b1cbc2794596f36e176f36784577f";
    $dal->insertTagRequest($url);
    $topTracksDOM->load($url); //get ficheiro XML do artista
    $topTracksDOM->save("xml/TopTracks.xml"); //guardar ficheiro

    $topTracks='xml/TopTracks.xml'; //carregar ficheiro XML
    $trackInfo=file_get_contents($topTracks); //buscar conteudo do XML

    $topTracksObj=new simplexmlelement($trackInfo); //cria um objecto a partir do XML

    $i=0;
?>

            <table border="1" class="resultsTable">
            <?php
                foreach($topTracksObj->toptracks->track as $track){
                $trackName = $track->name;
                $trackArtist = $track->artist->name;
                    ?>
                    <tr>
                        <!--usar funcao da tooltip para ser chamada-->
                         
                        <td onmouseover="showTrackInfo('<?php echo $trackName; ?>','<?php echo $trackArtist; ?>');">
                            <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                            <?php echo $trackName; ?>
                            
                            <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                        </td>
                     </tr>   
                <?php    
                    $i++;
                    if($i == $nTrack){
                        break;
                    }
                }
            ?>
            </table>
        </div>
    </div>