<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    //import delle credenziali di accesso ai database
    $DB_ACCESS = include('db_credentials.php');
    
    
    //connesisone al database covid_main
    $COVID_DB_CONN = new mysqli( $DB_ACCESS['covid']['host'],
                                 $DB_ACCESS['covid']['username'],
                                 $DB_ACCESS['covid']['password'],
                                 $DB_ACCESS['covid']['database'] );
                                 
    //connessione al datbase di wordpress
    $WP_DB_CONN = new mysqli( $DB_ACCESS['wp']['host'],
                              $DB_ACCESS['wp']['username'],
                              $DB_ACCESS['wp']['password'],
                              $DB_ACCESS['wp']['database'] );
    
    //check delle connessioni ai database
    if ( $COVID_DB_CONN->connect_error ) {
        die("Database Error.");
    }
    
    $DATE = $COVID_DB_CONN->query("SELECT date FROM covid_data WHERE location = 'World' ORDER BY date DESC LIMIT 1")->fetch_assoc()['date'];

    
    switch( $_SERVER["SCRIPT_NAME"] ) {
        
        case '/index.php':
            $CURRENT_PAGE = "Dashboard";
            $PAGE_TITLE = "Dashboard | Covid Tracker 2020";
            $PAGE_DESCRIPTION = "COVID-19 real time data counter. Keep track of all coronavirus today cases, deaths, and all other news. Download COVID-19 data in PDF and other formats.";
            $PAGE_KEYWORDS = "COVID, CASES TODAY, NEW CASES, DEATHS TODAY, NEW DEATHS, COVID-19, CORONAVIRUS, COUNTER, DEATH RATE, TESTS";
            $PAGE_PREVIEW_IMAGE = "/images/covidtracker2020_logo_image.png";
            break;
        
        case '/pages/repository/index.php':
            $CURRENT_PAGE = "Repository";
            $PAGE_TITLE = "Coronavirus Cases Today";
            $PAGE_DESCRIPTION = "COVID-19 real time data counter. Keep track of all coronavirus today cases, deaths, and all other news. Download COVID-19 data in PDF and other formats.";
            $PAGE_KEYWORDS = "COVID, CASES TODAY, NEW CASES, DEATHS TODAY, NEW DEATHS, COVID-19, CORONAVIRUS, COUNTER, DEATH RATE, TESTS";
            $PAGE_PREVIEW_IMAGE = "/images/covidtracker2020_logo_image.png";
            break;
             
        case '/pages/countries/index.php':
            $CURRENT_PAGE = "Countries";
            include '/home/covid/public_html/pages/counters_managment.php';

            $countries_list = getAllCountries( $COVID_DB_CONN );
            if( isset( $_GET['country'] ) ) {
                if( array_search( str_replace("_"," ",$_GET['country']), $countries_list ) !== FALSE ) {
                    $chosen_country = str_replace("_"," ",$_GET['country']);
                }
                $PAGE_TITLE = $chosen_country . " Coronavirus Data & Map | Covid Tracker 2020";
                $PAGE_DESCRIPTION = "COVID-19 real time data counters and map. Keep track of all " . $chosen_country . " Coronavirus data updates. Download virus data in PDF and other formats.";
            } else {
                $PAGE_TITLE = "World Countries Coronavirus Data & Map | Covid Tracker 2020";
                $PAGE_DESCRIPTION = "COVID-19 real time data counters and map. Keep track of all World Countries Coronavirus data updates. Download virus data in PDF and other formats.";
            }
            
            $PAGE_KEYWORDS = "COVID, CASES TODAY, NEW CASES, DEATHS TODAY, NEW DEATHS, COVID-19, CORONAVIRUS, COUNTER, DEATH RATE, TESTS"; 
            $PAGE_PREVIEW_IMAGE = "/images/covidtracker2020_logo_image.png";
            break;
            
        case '/pages/continents/index.php':
            $CURRENT_PAGE = "Continents";
            
            $chosen_continent = "world";

            $continents_list = array( "Europe", "Asia", "Africa", "North_America", "Oceania", "South_America", "world" );
            
            if( isset( $_GET['continent'] ) ) {
                if( array_search( $_GET['continent'], $continents_list ) !== FALSE ) {
                    $chosen_continent = str_replace("_"," ",$_GET['continent']);
                }
            }
            
            $PAGE_TITLE = $chosen_continent . " Coronavirus Data & Map | Covid Tracker 2020";
            $PAGE_DESCRIPTION = "COVID-19 real time data counters and map. Keep track of all " . $chosen_continent . " Coronavirus data updates. Download virus data in PDF and other formats.";
            $PAGE_PREVIEW_IMAGE = "https://www.covidtracker2020.live/images/previews/" . strtolower(str_replace(" ","_",$chosen_continent)) . ".png";
            $PAGE_KEYWORDS = "COVID, CASES TODAY, NEW CASES, DEATHS TODAY, NEW DEATHS, COVID-19, CORONAVIRUS, COUNTER, DEATH RATE, TESTS";
            break;
            
        case '/pages/map/index.php':
            $CURRENT_PAGE = "Map";
            $PAGE_TITLE = "Map | Covid Tracker 2020";
            $PAGE_DESCRIPTION = "COVID-19 real time data counter. Keep track of all coronavirus today cases, deaths, and all other news. Download COVID-19 data in PDF and other formats.";
            $PAGE_KEYWORDS = "COVID, CASES TODAY, NEW CASES, DEATHS TODAY, NEW DEATHS, COVID-19, CORONAVIRUS, COUNTER, DEATH RATE, TESTS";
            $PAGE_PREVIEW_IMAGE = "/images/covidtracker2020_logo_image.png";
            break;
    }

?>