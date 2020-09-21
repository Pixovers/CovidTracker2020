<?php


//restituisce il numero di giorni del mese passato alla funzione.
//il mese può essere passato via intero (da 1 a 12) oppure tramite nome del mese
function getMonthDays( $month ) {

    //nomi del mese
    $month_names = array( "january",
                          "february",
                          "march",
                          "april",
                          "may",
                          "june",
                          "july",
                          "august",
                          "september",
                          "october",
                          "november",
                          "december");

    //giorni del mese
    $month_days = array( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
    
    //check del tipo
    if( is_int( $month ) ) {
        //mese passato tramite intero
        return $month_days[ ( $month - 1 ) % 12 ];
    } else if( is_string( $month ) ) {
        //mese passato tramite stringa di testo
        $search_result = array_search( $month, $month_names );
        if( $search_result !== NULL ) {
            return $month_days[ $search_result ];
        }
    } else {
        //tipo non valido
        return NULL;
    }
}

//restituisce tutte le date a partire da $start_date che differiscono per un intervallo $interval_unit.
//$interval_unit può essere: "months", "days", "years"
function intervalsFromDate( $start_date, $interval_unit ) {

    $interval_count = 0;

    $intervals = array();

    while( date( "Y-m-d", strtotime($start_date." +".$interval_count." ".$interval_unit) ) < date("Y-m-d") ) {
        
        $intervals[] = date( "Y-m-d", strtotime($start_date." +".$interval_count." ".$interval_unit) );
        ++$interval_count;
    }

    return $intervals;
}

//restituisce la lista dei mesi a partire dalla data $start_date
function monthsListFromDate( $start_date ) {

    $month_names = array(   "january",
                            "february",
                            "march",
                            "april",
                            "may",
                            "june",
                            "july",
                            "august",
                            "september",
                            "october",
                            "november",
                            "december");
    
    $months_dates = intervalsFromDate($start_date,"months");
    for( $i = 0; $i < count( $months_dates ); $i++ ) {
        $months_dates[$i] = $month_names[ intval( explode( "-", $months_dates[$i] )[1] ) - 1 ];
    }

    return $months_dates;
}

?>