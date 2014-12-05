<?php

    global $artist;
    global $nTrack;
    $artist = $_REQUEST['artist'];
    $nTrack = $_REQUEST['nTracks'];
    
    if($artist=="") $artist= "Marillion"; 
    if($nTrack=="") $nTrack = "10";
        
    include('DAL.php');
    $dal = new DAL();
    
    $artistDOM = new DOMDocument('1.0', 'ISO-8859-1'); 
    
    $url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptags&artist=$artist&api_key=376b1cbc2794596f36e176f36784577f";
    $dal->insertArtistRequest($url);
    
    $artistDOM->load($url); //get ficheiro XML do artista
    $artistDOM->save("xml/artTopTags.xml"); //guardar ficheiro

    $topTagsObj=new simplexmlelement($artistDOM); //cria um objecto a partir do XML

    $artista= $topTagsObj->toptags->attributes(); //get artista de acordo com a localizacao no ficheiro XML
    ?>
    
    <!--processamento da table HTML-->
    
        <table border="1" class="resultsTable">
            <tr>
                <?php
                $nTrackAux = $nTrack;
                foreach($artObj->toptags->tag as $tags){ //percorrer todas as tags
                    $tagName= $tags->name;//sem parenteses pq nao e atributo
                    $tagCount= $tags->count;//sem parenteses pq nao e atributo
                    if($tagCount == 0)
                        break;
                    $tagUrl= $tags->url;

                    ?>

                    <td class="white" title="<?php 
                    echo $tagCount;
                    if($tagCount == 1){echo " music";} else {echo " musics";}
                
                    // se a quantidade de musicas disponiveis pelos resultados da 
                    // tag for menor que o numero que o utilizador introduziu de
                    // limite, este e substituido por esse novo limite.
                    if($tagCount < $nTrackAux)
                        $nTrackAux = $tagCount;

                    ?>" onclick="MakeXMLHTTPCallTracks('<?php echo $tagName; ?>','<?php echo $nTrack; ?>');"><span><a href="#"><?php echo $tagName;?></a></span> </td>

                    </tr>
                <?php
            }?>

        </table>
