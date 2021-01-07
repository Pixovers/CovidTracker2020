<?php

/*
 * Classe:          Count
 * Descrizione:     Gestione e implementazione di un counter da utilizzare nella pagina live
 *                  
 */
class Count {
    protected $parameters;          //parametri del database, passati come array di stringhe
    protected $connection;          //connessione al database
    protected $table;               //tabella
    protected $date_column;         //nome della colonna con la data
    protected $conditions;          //condizioni
    protected $values;              //valori calcolati. (start_value e delay, per ogni parametro)
    protected $name;                //nome del counter.
    
    /*
     *  Descrizione:            Costruttore
     *  Parametri:      $connection:    connessione al database
     *                  $table:         tabella del database
     *                  $parameters:    array dei parametri
     *                  $date_column:   nome della colonna della data
     *                  $conditions:    array con le condizioni.
     *                                  formato degli elementi: parametro => valore
     *                                  n.b. deve essere presente anche la data
     *  
     */
    public function __construct( $connection,
                                 $table,
                                 $parameters,
                                 $date_column,
                                 $conditions )
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->parameters = $parameters;
        $this->conditions = $conditions;
        $this->date_column = $date_column;
        
        foreach( $this->conditions as $param => $value ) {
            if( $param != $this->date_column ) {
                $this->name = $value;
                break;
            }
        }    
        
        $this->Evaluate();

    }
    
    //effettua tutti i calcoli della classe
    public function Evaluate() {
        
        //creazione della query
        $sql_text = "SELECT " . 
                    implode( ",", $this->parameters ) . 
                    " FROM $this->table WHERE ( $this->date_column ='".$this->conditions[$this->date_column].
                    "' OR $this->date_column = '".date('Y-m-d', strtotime('-1 day', strtotime($this->conditions[$this->date_column])))."' )  ";
        
        foreach( $this->conditions as $param => $value ) {
            if( $param != $this->date_column ) {
                $sql_text .= "AND " . $param . "=\"" . $value . "\",";
            }
        }
        
        $sql_text = substr($sql_text,0,-1) . " ORDER BY $this->date_column DESC";
        
        $sql_exec = $this->connection->query( $sql_text );
        //esecuzione query
        while( $row = $sql_exec->fetch_assoc() ) {
            $sql_result[] = $row;
        }

        
        //secondi dall'inizio della giornata fino ad'ora
        $seconds = time() - strtotime("today");
        
        $this->values = array();
        
        for( $i = 0; $i < count( $this->parameters ); $i++ ) {
            
            $start_value = $sql_result[0][$this->parameters[$i]];
            $delta = $sql_result[0][$this->parameters[$i]] - $sql_result[1][$this->parameters[$i]];
            $progress = intval( $delta * $seconds / 86400  );
            if ($delta <= 0) $delay = 999999999;
            else $delay = intval(86400/intval($delta)*1000.0);
            
            //check della data: se la mezzanotte è passata, vengono aggiunti i dati del giorno prima
            if( date("Y-m-d") > $GLOBALS["DATE"] ) {
                $start_value += $delta;
            }
            $start_value += $progress;
            $this->values+= array( $this->parameters[$i] => array( $start_value, $delay ) );
            
        }
        
        //echo var_dump( $this->values );
        
        
    }
    
    //restituisce il codice JavaScript da eseguire per attivare il counter
    public function GetJS( $param ) {
        return "counter(\"".$this->name."_$param\",".$this->values[$param][1].",".$this->values[$param][0].");";
    }
    
    public function GetAllJS() {
        $temp = "";
        foreach( $this->parameters as $param ) {
            $temp .= $this->GetJS($param);    
        }
        return $temp;
    }
    
    //restituisce il codice html, ovverlo l'oggetto DOM 
    public function GetDOM( $param ) {
        return "<span id=\"".$this->name."_$param\">".$this->values[$param][0]."</span>";
    }
    
    
    //metodi GETTER SETTER
    
    public function GetParamaters() {
        return $this->parameters;
    }
    
    public function GetConnection() {
        return $this->connection;
    }
    
    public function GetTable() {
        return $this->table;
    }
    
    public function GetConditions() {
        return $this->conditions;
    }
    
    public function GetDateColumn() {
        return $this->date_column;
    }
    
    public function GetName() {
        return $this->name;
    }
    
    public function SetParamaters( $parameters ) {
        $this->parameters = $parameters;
    }
    
    public function SetConnection( $connection ) {
        $this->connection = $connection;
    }
    
    public function SetTable( $table ) {
        $this->table = $table;
    }
    
    public function SetConditions( $conditions ) {
        $this->conditions = $conditions;
    }
    
    public function SetDateColumn( $date_column ) {
        $this->date_column = $date_column;
    }
    
    public function SetName( $name ) {
        $this->name = $name;
    }
    
}

/*
 * Classe:          CounterRegioni
 * Descrizione:     Counter con i dati delle regioni d'italia
 *                  
 */
class CounterRegioni extends Count {
    public function __construct( $regione ) {
        parent::__construct( $GLOBALS['COVID_IT_DB_CONN'], 
                    "dati_regioni",
                    array( "totale_casi", "deceduti", "tamponi" ),
                    "data",
                    array( "data" => $GLOBALS['DATE'], 
                           "denominazione_regione" => $regione )
                  );
    }
    

}

/*
 * Classe:          CounterItalia
 * Descrizione:     Counter con i dati dell'italia
 *                  
 */
class CounterItalia extends Count {
    
    //costruttore
    public function __construct() {
        parent::__construct( $GLOBALS['COVID_IT_DB_CONN'], 
                    "dati_italia",
                    array( "totale_casi", "deceduti", "tamponi", "totale_positivi", "dimessi_guariti", "casi_testati" ),
                    "data",
                    array( "data" => $GLOBALS['DATE'] )
                  );
        $this->name = "Italia";
    }
    

}


/*
 * Classe:          CounterContinent
 * Descrizione:     Counter con i dati di un continente
 *                  
 */
class CounterContinent extends Count {
    //Costruttore
    //  $country:       nome del continente di cui realizzare il counter
    public function __construct( $continent ) {

        parent::__construct( $GLOBALS['COVID_DB_CONN'], 
                    "covid_data_".str_replace(" ","_",$continent),
                    array( "total_cases", "total_deaths" ),
                    "date",
                    array( "date" => $GLOBALS['DATE'] )
                  );
        $this->name = $continent;
    }
}

/*
 * Classe:          CounterCountry
 * Descrizione:     Counter con i dati di una nazione
 *                  
 */
class CounterCountry extends Count {
    
    //Costruttore
    //  $country:       nome della nazione di cui realizzare il counter
    public function __construct( $country ) {
    
        parent::__construct( $GLOBALS['COVID_DB_CONN'], 
                    "covid_data",
                    array( "total_cases", "total_deaths" ),
                    "date",
                    array( "date" => $GLOBALS['DATE'],
                           "location" => $country )
                  );
        $this->name = $country;
    }
}

/*
 * Classe:          CounterWorld
 * Descrizione:     Counter con i dati del mondo
 *                  
 */
class CounterWorld extends CounterCountry {
    
    //costruttore
    public function __construct() {

        parent::__construct( "World" );
        
    }
}





?>
