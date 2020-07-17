
<?php
    $host="localhost";                  //nome host
    $db_user="root";                    //username MySql
    $db_password="";                    //password MySql
    $db='covid_db';                     //nome database
    $table_name = 'covid_data';         //nome tabella


    //conneccione con il database
    $connection=new mysqli($host,$db_user,$db_password);


    //controllo della connessione
    if ( $connection->connect_error )
    {
        //errore di connessione
        echo "Failed to connect to MySQL: " . mysqli_connect_error() . "\n";
    } else {

        //Connessione stabilita correttamente

        //Check del database. Se non esiste, viene creato
        if( $connection->select_db($db) === false ) {
            $connection->query("CREATE DATABASE $db");
            $connection->select_db($db);
        }

        //creazione tabella 
        $connection->query( "CREATE TABLE covid_data (".
                            "id INT AUTO_INCREMENT PRIMARY KEY,".
                            "iso_code VARCHAR(3),".
                            "continent VARCHAR(16),".
                            "location VARCHAR(64),".
                            "date DATE,".
                            "total_cases INT,".
                            "new_cases INT,".
                            "total_deaths INT,".
                            "new_deaths INT,".
                            "total_cases_per_million INT,".
                            "new_cases_per_million INT,".
                            "total_deaths_per_million INT,".
                            "new_deaths_per_million INT,".
                            "total_tests INT,".
                            "new_tests INT,".
                            "total_tests_per_thousand INT,".
                            "new_tests_per_thousand INT,".
                            "new_tests_smoothed INT,".
                            "new_tests_smoothed_per_thousand INT,".
                            "tests_units INT,".
                            "stringency_index INT,".
                            "population INT,".
                            "population_density INT,".
                            "median_age INT,".
                            "aged_65_older INT,".
                            "aged_70_older INT,".
                            "gdp_per_capita INT,".
                            "extreme_poverty INT,".
                            "cvd_death_rate INT,".
                            "diabetes_prevalence INT,".
                            "female_smokers INT,".
                            "male_smokers INT,".
                            "handwashing_facilities INT,".
                            "hospital_beds_per_thousand INT,".
                            "life_expectancy INT".
                            ")" );
    }
    
    //CSV filename
    echo $filename="https://raw.githubusercontent.com/owid/covid-19-data/master/public/data/owid-covid-data.csv";

    //estensione del file
    $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));


    //verifica se l'estensione del file è .CSV
    if($ext==".csv")
    {
        //il file è CSV


        //eliminazione dei vecchi dati dalla tabella
        $connection->query( "TRUNCATE `$db`.`$table_name`" );
        
        //Apertura in lettura del file csv
        $file = fopen($filename, "r");
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
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
                       "total_cases_per_million," .
                       "new_cases_per_million," .
                       "total_deaths_per_million," .
                       "new_deaths_per_million," .
                       "total_tests," .
                       "new_tests," .
                       "total_tests_per_thousand," .
                       "new_tests_per_thousand," .
                       "new_tests_smoothed," .
                       "new_tests_smoothed_per_thousand," .
                       "tests_units," .
                       "stringency_index," .
                       "population," .
                       "population_density," .
                       "median_age," .
                       "aged_65_older," .
                       "aged_70_older," .
                       "gdp_per_capita," .
                       "extreme_poverty," .
                       "cvd_death_rate," .
                       "diabetes_prevalence," .
                       "female_smokers," .
                       "male_smokers," .
                       "handwashing_facilities," .
                       "hospital_beds_per_thousand," .
                       "life_expectancy" .
                       " ) " . 
                       "values ( " .
                       "'$emapData[0]'," .
                       "'$emapData[1]'," .
                       "'$emapData[2]'," .
                       "'$emapData[3]'," .
                       "'$emapData[4]'," .
                       "'$emapData[5]'," .
                       "'$emapData[6]'," .
                       "'$emapData[7]'," .
                       "'$emapData[8]'," .
                       "'$emapData[9]'," .
                       "'$emapData[10]'," .
                       "'$emapData[11]'," .
                       "'$emapData[12]'," .
                       "'$emapData[13]'," .
                       "'$emapData[14]'," .
                       "'$emapData[15]'," .
                       "'$emapData[16]'," .
                       "'$emapData[17]'," .
                       "'$emapData[18]'," . 
                       "'$emapData[19]'," .
                       "'$emapData[20]'," .
                       "'$emapData[21]'," .
                       "'$emapData[22]'," .
                       "'$emapData[23]'," .
                       "'$emapData[24]'," .
                       "'$emapData[25]'," .
                       "'$emapData[26]'," .
                       "'$emapData[27]'," .
                       "'$emapData[28]'," .
                       "'$emapData[29]'," .
                       "'$emapData[30]'," .
                       "'$emapData[31]'," .
                       "'$emapData[32]'," .
                       "'$emapData[33]'" .
                       ")";
                $connection->query( $sql );
            }
            fclose($file);
            echo "CSV File has been successfully Imported.";
    }
    else {
        //il file non è CSV
        echo "Error: Please Upload only CSV File";
    }

    //chiusura connessione MySql
    $connection->close();


?>