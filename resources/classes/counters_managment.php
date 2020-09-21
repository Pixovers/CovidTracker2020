<?php

    function getCurrentValue( $connection, $location, $value, $changed ) {

        //data attuale
        $dateToShow = date("Y-m-d");
        $isToday = True;
            
        if( $connection->query("SELECT * FROM covid_data WHERE date = '$dateToShow'")->num_rows == 0 ) {
            $dateToShow = date("Y-m-d",strtotime("-1 days") );
            $isToday = false;
        }

        $continents = array( "Africa", "Europe", "Asia", "Oceania", "South America", "North America");
        
        $total = 0;
        $lastChange = 0;
        
        if( array_search( $location, $continents ) !== false ) {
            $total = $connection->query("SELECT ".$value." FROM covid_data_".str_replace(" ","_",$location)." WHERE date = '".$dateToShow."' ")->fetch_assoc()[$value] . ",";
            $lastChange = $connection->query("SELECT ".$changed." FROM covid_data_".str_replace(" ","_",$location)." WHERE date = '".$dateToShow."' ")->fetch_assoc()[$changed] . ",";
        } else {
            
        

        //creazione del testo della query
        $sql =  "SELECT " . $changed . " ".
                "FROM covid_data ".
                "WHERE date = '" . $dateToShow . "' AND location = '" . $location . "'";     

        $lastChange = intval( $connection->query($sql)->fetch_assoc()[$changed] );

        //creazione del testo della query
        $sql =  "SELECT " . $value . " ".
                "FROM covid_data ".
                "WHERE date = '" . $dateToShow . "' AND location = '" . $location . "'";

        
        $total = $connection->query($sql)->fetch_assoc()[$value];
        }
        
        $estimated_progress = intval( $lastChange * (time() - strtotime("today")) / 86400  );
        if( !$isToday ) {
            $total = $total + $lastChange;
        }

        return $total+$estimated_progress;
        
    }

    function getCurrentDelay( $connection, $location, $value ) {
        
        //data attuale
        $dateToShow = date("Y-m-d");
        $isToday = True;
            
        if( $connection->query("SELECT * FROM covid_data WHERE date = '$dateToShow'")->num_rows == 0 ) {
            $dateToShow = date("Y-m-d",strtotime("-1 days") );
            $isToday = false;
        }

        $continents = array( "Africa", "Europe", "Asia", "Oceania", "South America", "North America");

        $total_value = 0;

        if( array_search( $location, $continents ) !== false ) {
            $total_value = $connection->query("SELECT ".$value." FROM covid_data_".str_replace(" ","_",$location)." WHERE date = '".$dateToShow."' ")->fetch_assoc()[$value];
            
        } else {
            //creazione del testo della query
            $sql =  "SELECT " . $value . " ".
                    "FROM covid_data ".
                    "WHERE date = '" . $dateToShow . "' AND location = '" . $location . "'";  
            $total_value = $connection->query($sql)->fetch_assoc()[$value];
        }

        if( $total_value > 0 ) 
            return intval(86400/intval($total_value)*1000.0);
        else return 999999999;
        
    }

    function getValueFromContinent( $connection, $continent, $value, $dateToShow = "" ) {

        if( $dateToShow == "" ) {
            $dateToShow == date( "Y-m-d" );
            if( $connection->query("SELECT * FROM covid_data WHERE date = '$dateToShow'")->num_rows == 0 ) {
                $dateToShow = date("Y-m-d",strtotime("-1 days") );
            }
        }
        
        $countries = $connection->query( "SELECT DISTINCT location FROM covid_data ".
                                             "WHERE continent = '$continent'" );
        $return_value = 0;


        while($row = $countries->fetch_assoc()) {
            $sql =  "SELECT " . $value . " ".
                    "FROM covid_data ".
                    "WHERE date = '" . $dateToShow . "' AND location = '" . $row['location'] . "'";  
            $return_value += $connection->query($sql)->fetch_assoc()[$value];
        }
    
        return $return_value;
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

?>