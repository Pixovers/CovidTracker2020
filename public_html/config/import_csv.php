
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include '/home/covid/public_html/pages/date_managment.php';
    include '/home/covid/public_html/pages/flags_managment.php';

    //credenziali del database
    include '/home/covid/public_html/config/database.php';
    
    //connessione con il database
    $connection = new mysqli($servername,$username,$password);
    
    //Check del database. Se non esiste, viene creato
    if( $connection->select_db($db) === false ) {
        $connection->query("CREATE DATABASE $db");
        $connection->select_db($db);
    }
    
    $query_count = 0;

    function getValueFromContinent( $connection, $continent, $value, $dateToShow = "" ) {
        
        if( $dateToShow == "" ) {
            $dateToShow = date( "Y-m-d" );
            if( $connection->query("SELECT * FROM covid_data WHERE date = '$dateToShow'")->num_rows == 0 ) {
                $dateToShow = date("Y-m-d",strtotime("-1 days") );
            }
        }

        $countries = $connection->query( "SELECT DISTINCT location FROM covid_data ".
                                             "WHERE continent = '$continent'" );
        $return_value = 0;


        while($row = $countries->fetch_assoc()) {
            $GLOBALS['query_count']++;
            $sql =  "SELECT " . $value . " ".
                    "FROM covid_data ".
                    "WHERE date = '" . $dateToShow . "' AND location = '" . $row['location'] . "'";  
            $return_value += $connection->query($sql)->fetch_assoc()[$value];
        }
    
        return $return_value;
    }
    
    function load_continent( $continent_name ) {
        $start = microtime(true);
        $continent_table_name = "covid_data_".str_replace(" ","_",$continent_name);
        //creazione tabella (se non esiste già)
        $GLOBALS['connection']->query( "CREATE TABLE ".$continent_table_name." (".
                                        "id INT AUTO_INCREMENT PRIMARY KEY,".
                                        "date DATE,".
                                        "total_cases INT,".
                                        "new_cases INT,".
                                        "total_deaths INT,".
                                        "new_deaths INT,".
                                        "new_tests INT,".
                                        "total_tests INT".
                                        ")" );
                                        
        //eliminazione dei vecchi dati dalla tabella
        $GLOBALS['connection']->query( "TRUNCATE `".$GLOBALS['db']."`.`$continent_table_name`" );
        

                                       
        foreach( intervalsFromDate( "2020-01-01", "months" ) as $date ) {
            $GLOBALS['connection']->query( "INSERT INTO $continent_table_name (date, total_cases, new_cases, total_deaths, new_deaths, new_tests, total_tests) " .
                                           "VALUES (".
                                           "'".$date."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_cases", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_cases", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_deaths", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_deaths", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_tests", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_tests", $date )."'".
                                           ")" );
        }
        for( $i = 7; $i >= 0; $i-- ) {
            $date = date( "Y-m-d", strtotime(date("Y-m-d")." -".$i." days"));
            $GLOBALS['connection']->query( "INSERT INTO $continent_table_name (date, total_cases, new_cases, total_deaths, new_deaths, new_tests, total_tests) " .
                                           "VALUES (".
                                           "'".$date."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_cases", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_cases", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_deaths", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_deaths", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "new_tests", $date )."',".
                                           "'".getValueFromContinent( $GLOBALS['connection'], $continent_name, "total_tests", $date )."'".
                                           ")" );
            
        }

        
        return microtime(true) - $start;
    }
    
    //carica tutti i dati nel database, dal file csv remoto
    function load_covid_data( $remote_filename ) {
        $start = microtime(true);
        //creazione tabella (se non esiste già)
        $GLOBALS['connection']->query( "CREATE TABLE covid_data (".
                            "id INT AUTO_INCREMENT PRIMARY KEY,".
                            "iso_code VARCHAR(3),".
                            "continent VARCHAR(16),".
                            "location VARCHAR(64),".
                            "date DATE,".
                            "total_cases INT,".
                            "new_cases INT,".
                            "total_deaths INT,".
                            "new_deaths INT,".
                            "new_tests INT,".
                            "total_tests INT".
                            ")" );
                            
        //eliminazione dei vecchi dati dalla tabella
        $GLOBALS['connection']->query( "TRUNCATE `".$GLOBALS['db']."`.`covid_data`" );
        
        //Apertura in lettura del file csv
        $file = fopen($remote_filename, "r");
                
        while (($data_column = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $sql = "INSERT into covid_data( " .
                   "iso_code," .
                   "continent," .
                   "location," .
                   "date," .
                   "total_cases," .
                   "new_cases," .
                   "total_deaths," .
                   "new_deaths," .
                   "new_tests," .
                   "total_tests" .
                   " ) " . 
                   "values ( " .
                   "'$data_column[0]'," .
                   "'$data_column[1]'," .
                   "'$data_column[2]'," .
                   "'$data_column[3]'," .
                   "'$data_column[4]'," .
                   "'$data_column[5]'," .
                   "'$data_column[7]'," .
                   "'$data_column[8]'," .
                   "'$data_column[14]'," .
                   "'$data_column[15]'" .
                   ")";
                   
            $GLOBALS['connection']->query( $sql );
        }
        fclose($file);
        return microtime(true) - $start;
    }
    
    function getAllCountries( $connection ) {
        $countries = $connection->query("SELECT DISTINCT location FROM covid_data" );

        $exeptions_list = array( "location", "World", "International" );

        $countries_list = [];

        while($row = $countries->fetch_assoc()) {
            if( array_search( $row['location'], $exeptions_list ) === false ) {
                array_push( $countries_list, $row['location'] );
            }
        }

        return $countries_list;
        
    }
    
    function load_map() {
        $start = microtime(true);
        $colors_file = fopen("world_map_colors.dat", "w");
        $data_file = fopen("world_map_data.dat", "w");
        
        $countries = getAllCountries( $GLOBALS['connection'] );

        for( $i = 0; $i < count( $countries ); $i++ ) {
            fwrite($colors_file,'"'.CountryToIso($GLOBALS['connection'],$countries[$i]).'":"'.
            $GLOBALS['connection']->query("SELECT total_cases FROM covid_data WHERE location = '".$countries[$i]."' ORDER BY date DESC" )->fetch_assoc()['total_cases'].'",');
            
            
            
            $sql_text = "SELECT total_cases, new_cases, total_deaths, new_deaths ".
                        "FROM covid_data ".
                        "WHERE location = '".$countries[$i]."' ORDER BY date DESC";
              
            $row = $GLOBALS['connection']->query($sql_text)->fetch_assoc();

            fwrite($data_file,'["'.CountryToIso($GLOBALS['connection'],$countries[$i]).'","'.$countries[$i].'",'.$row['total_cases'].','.$row['new_cases'].','.$row['total_deaths'].','.$row['new_deaths'].'],');
        }
        return microtime(true) - $start;
    }
    
    function create_iso_table() {
        $GLOBALS['connection']->query(  "CREATE TABLE iso_table (".
                                        "id INT AUTO_INCREMENT PRIMARY KEY,".
                                        "iso_code_a2 VARCHAR(2),".
                                        "iso_code_a3 VARCHAR(3),".
                                        "country VARCHAR(64)".
                                        ")" );
        
        $GLOBALS['connection']->query( "TRUNCATE `".$GLOBALS['db']."`.`iso_table`" );
                             
        $countries = $GLOBALS['connection']->query("SELECT DISTINCT location, iso_code FROM covid_data" );

        $exeptions_list = array( "location", "World", "International" );

        $countries_list = [];

        while($row = $countries->fetch_assoc()) {
            if( array_search( $row['location'], $exeptions_list ) === false ) {
                $GLOBALS['connection']->query( "INSERT INTO iso_table (iso_code_a2, iso_code_a3, country) VALUES ('".CountryToIso($GLOBALS['connection'],$row['location'])."','".strtolower($row['iso_code'])."','".$row['location']."') ");
            }
        }
    }
    
    function load_all( $remote_csv_file ) {

        

        $start = microtime(true);
        
        echo "Caricamento dati dal file csv - Durata: " . load_covid_data( $remote_csv_file ) . "s<br>";
        echo "Elaborazione dati mappa - Durata: " . load_map() . "s<br><br>";
        
        $continents = array( "Oceania", "Europe", "North America", "South America" );
        foreach( $continents as $continent ) {
            $time = load_continent( $continent);
            echo "Elaborazione " . $continent . " - Durata: " . $time . "s - Tempo di esecuzione di una query: ".($time/$GLOBALS['query_count'])."<br>";
        }
        echo "<br><br><b>Tempo totale di esecuzione: " . (microtime(true) - $start) . "s - Query eseguite: ".$GLOBALS['query_count']."</b><br>";
        
    
        create_iso_table();
        
    }

    $remote_csv_file = "https://raw.githubusercontent.com/owid/covid-19-data/master/public/data/owid-covid-data.csv";

    $local_timestamp_filename = "/home/covid/public_html/config/database_timestamp.txt";
    $remote_timestamp_filename = "https://raw.githubusercontent.com/owid/covid-19-data/master/public/data/owid-covid-data-last-updated-timestamp.txt";

    
    if( file_get_contents($local_timestamp_filename) == file_get_contents($remote_timestamp_filename) ) {

        echo "Il database è già aggiornato!<br>";
        echo "Timestamp ultimo aggiornamento: <b>".file_get_contents($local_timestamp_filename)."</b><br><br>";
        
        echo '<form method="get"><button name="reload" type="submit" value="true">Aggiorna comunque</button></form>';
        if( isset( $_GET['reload'] ) ) {
            if( $_GET['reload'] == "true" ) {
                load_all( $remote_csv_file );
            }
        }
        
    } else {
        $local_timestamp_file = fopen($local_timestamp_filename, "w" );
        fwrite($local_timestamp_file, file_get_contents($remote_timestamp_filename) );
        
        load_all( $remote_csv_file );

        fclose($local_timestamp_file);
    }
    
    
    //chiusura connessione MySql
    $connection->close();




?>