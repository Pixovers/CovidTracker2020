
<?php
    include "/home/covid/public_html/config/imports.php";

    
    if( file_get_contents($local_timestamp_filename) == file_get_contents($remote_timestamp_filename) ) {

        echo "Il database è già aggiornato!<br>";
        echo "Timestamp ultimo aggiornamento: <b>".file_get_contents($local_timestamp_filename)."</b><br><br>";
        
    } else {

        echo "Caricamento dati dal file csv - Durata: " . load_covid_data( $remote_csv_file ) . "s<br>";
        echo "Elaborazione dati mappa - Durata: " . load_map() . "s<br><br>";

    }
    
    
    //chiusura connessione MySql
    $connection->close();




?>