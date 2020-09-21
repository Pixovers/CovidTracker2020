<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//credenziali di accesso al database
include '../config/database.php';
include '/home/covid/resources/classes/table.php';
$start = microtime(true);

//connessione al database mySql
$conn = new mysqli($servername, $username, $password, $db );

//setup dell header: file JSON
header('Content-Type: application/json');

//verifica che il parametro type sia stato passato. 
//Il parametro type specifica la struttura della tabella
if( isset( $_GET['type']) ) {
    
    //array rows utilizzato per memorizzare le righe della tabella
    $rows = array();
    
    //esecuzione delle istruzioni corrispondenti al type passato come parametro GET
    if( $_GET['type'] == "country_list" &&
        isset($_GET['date']) &&
        isset($_GET['location']) ) 
    {
        //creazione di un oggetto Table della tipologia corretta
        $current_table = new CountryListTable();
            
        //creazione del testo della query del contenuto della tabella
        $sql_text = "SELECT  ";
        foreach( $current_table->getParameters() as $param ) {
            $sql_text .= $param[2].",";
        }
            
        $sql_text = rtrim($sql_text,",");
            
        $sql_text .= " FROM covid_data WHERE date = '".$_GET['date']."' ";
            
        if( $_GET['location'] != "World" ) {
           $sql_text .= "AND continent = '".str_replace("_", " ",$_GET['location'])."'";
        }
            
        //esecuzione della query
        $result = $conn->query("$sql_text");
        
        //parametri attuali
        $params = $current_table->getParameters();
            
        while($query_row = $result->fetch_assoc()) {
            $current_row = array();
            
            $keys = array_keys($query_row);

            for( $i = 0; $i < count( $query_row ); $i++ ) {
                if( $keys[$i] == "location" ) {
                    $current_row += [$params[$i][1] => ('<a href="https://www.covidtracker2020.live/pages/countries/?country='.$query_row['location'].'">'.$query_row['location'].'</a>')];
                } else {
                    $current_row += [$params[$i][1] => $query_row[$keys[$i]]];
                }
            }
            $rows[] = $current_row;
        }
        
    } else if( $_GET['type'] == "country" &&
               isset($_GET['country'])  )
    {

        //creazione di un oggetto Table della tipologia corretta
        $current_table = new CountryTable();
            
        //creazione del testo della query del contenuto della tabella
        $sql_text = "SELECT  ";
        foreach( $current_table->getParameters() as $param ) {
            $sql_text .= $param[2].",";
        }
            
        $sql_text = rtrim($sql_text,",");
            
        $sql_text .= " FROM covid_data WHERE location = '".str_replace("_"," ",$_GET['country'])."' ORDER BY date DESC ";

        //esecuzione della query
        $result = $conn->query("$sql_text");
        
        //parametri attuali
        $params = $current_table->getParameters();
            
        while($query_row = $result->fetch_assoc()) {
            $current_row = array();
            
            $keys = array_keys($query_row);

            for( $i = 0; $i < count( $query_row ); $i++ ) {

                $current_row += [$params[$i][1] => $query_row[$keys[$i]]];
                
            }
            $rows[] = $current_row;
        }

    }
   
    $table = array( "total" => count($rows),
                    "totalNotFiltered" => count($rows),
                    "rows"=> $rows);
                        
    $json_table_text = json_encode($table);
    print_r($json_table_text);
}

?>