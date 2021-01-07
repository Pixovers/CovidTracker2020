
<?php
    include "/home/covid/public_html/config/imports.php";

    
    if( file_get_contents($local_timestamp_filename) == file_get_contents($remote_timestamp_filename) ) {

        echo "Il database è già aggiornato!<br>";
        echo "Timestamp ultimo aggiornamento: <b>".file_get_contents($local_timestamp_filename)."</b><br><br>";
        
    } else {
        $local_timestamp_file = fopen($local_timestamp_filename, "w" );
        fwrite($local_timestamp_file, file_get_contents($remote_timestamp_filename) );
        
        $continents = array( "Asia", "Africa" );
        foreach( $continents as $continent ) {
            $time = load_continent( $continent);
            echo "Elaborazione " . $continent . " - Durata: " . $time . "s - Tempo di esecuzione di una query: ".($time/$GLOBALS['query_count'])."<br>";
        }
        
        fclose($local_timestamp_file);
    }
    
    
    //chiusura connessione MySql
    $connection->close();




?>