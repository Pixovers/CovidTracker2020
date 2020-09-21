<?php


/*
 * Classe:          Table
 * Descrizione:     Creazione della struttura html di una tabella generica.
 *                    Utilizzata in ereditarietà per definire altre tabelle più complesse
 */   
class Table {
    
    //nome tabella
    protected $table_name;
    
    //parametri tabella
    protected $parameters;
    
    //url del file JSON contenente i dati per la tabella
    protected $url_data;


    //costruttore
    public function __construct( $table_name, $parameters, $url_data = "#" ) {
        $this->table_name = $table_name;
        $this->parameters = $parameters;
        $this->url_data = $url_data;
    }
    
    //-----
    
    //metodi GETTER - SETTER
    
    public function setTableName($table_name) {
        $this->table_name = $table_name;
    }
    
    public function getTableName() {
        return $this->table_name;
    }
        
    public function setParameters($parameters) {
        $this->parameters = $parameters;
    }
    
    public function getParameters() {
        return $this->parameters;
    }    
    
    public function getDataUrl() {
        return $this->url_data;
    }
    
    public function setDataUrl( $url_data ) {
        $this->url_data = $url_data;
    }
    
    // -----
    
    //Generazione codice html per la tabella
    public function genTable() {
        echo '<table class="table table-striped" '.
                    'id="Africa" '.
                    'data-toggle="table" '.
                    'data-height="600" '.
                    'data-show-toggle="true" '.
                    'data-detail-view="true" '.
                    'data-detail-view-icon="false" '.
                    'data-detail-formatter="detailFormatter" '.
                    'data-header-style="headerStyle" '.
                    'data-mobile-responsive="true" '.
                    'data-show-columns="true" '.
                    'data-search="true" '.
                    'data-search-align="left" '.
                    'data-sort-class="table-active" '.
                    'data-sortable="true" '.
                    'data-show-export="true" '.
                    'data-toolbar="#toolbar" '.
                    'data-show-print="true" '.
                    'data-click-to-select="true" '.
                    'data-url="'.$this->url_data.'">';
        echo '<thead class="thead-dark"><tr>';
        
        foreach( $this->parameters as $param) {
            echo '<th data-field="'.$param[1].'" scope="col" data-sortable="true">'.$param[0].'</th>';
        }

        echo '</tr></thead>';
        echo '</table>';
    }
}


/*
 * Classe:          CountryListTable
 * Descrizione:     Creazione della struttura html di una tabella contenente una lista
 *                  di nazioni. il parametro $location specifica la lista di nazioni.
 */   
class CountryListTable extends Table {
    
    //location specififca a che continent appartengono le nazioni.
    private $location;
    
    //data di visualizzazione dei dati
    private $date;
    

    //costruttore overloaded
    public function __construct( $location = "", $date = "" ) {
        
        //replace dei caratteri " " con "_", in modo da poter codificare il nome del continente in caso di nomi con spazi al loro interno
        $this->location = str_replace( " ", "_", $location );
        
        $this->date = $date;
        
        //chiamata al costruttore di Table
        parent::__construct(    $location, 
                                array(
                                    array( "NAME", "name", "location" ),
                                    array( "CONFIRMED", "confirmed", "total_cases" ),
                                    array( "CHANGES TODAY", "changes1", "new_cases" ),
                                    array( "DECEASED", "deceased", "total_deaths" ),
                                    array( "CHANGES TODAY", "changes2", "new_deaths" ),
                                    array( "TESTS", "tests", "total_tests" ),
                                    array( "CHANGES TODAY", "changes3", "new_tests" ),
                                ),
                                "https://www.covidtracker2020.live/pages/table_json_data.php?location=$this->location&date=$this->date&type=country_list");
    }
    
    //-----
    
    //metodi GETTER - SETTER
    
    function getLocation() {
        return $this->location;
    }
    
    function setLocation( $location ) {
        $this->location = $location;
    }
    
    function getDate() {
        return $this->date;
    }
    
    function setDate( $date ) {
        $this->date = $date;
    }

}



/*
 * Classe:          CountryTable
 * Descrizione:     Creazione della struttura html di una tabella contenente i dati di
 *                  una nazione (organizzata su più date)
 */   
class CountryTable extends Table {
    
    private $country;

    //costruttore overloaded
    public function __construct( $country = "" ) {
        
        //replace dei caratteri " " con "_", in modo da poter codificare il nome della nazione in caso di nomi con spazi al loro interno
        $this->country = str_replace( " ", "_", $country );
        
        //chiamata al costruttore di Table
        parent::__construct(    $country, 
                                array(
                                    array( "DATE", "date", "date" ),
                                    array( "CONFIRMED", "confirmed", "total_cases" ),
                                    array( "CHANGES TODAY", "changes1", "new_cases" ),
                                    array( "DECEASED", "deceased", "total_deaths" ),
                                    array( "CHANGES TODAY", "changes2", "new_deaths" ),
                                    array( "TESTS", "tests", "total_tests" ),
                                    array( "CHANGES TODAY", "changes3", "new_tests" ),
                                ),
                                "https://www.covidtracker2020.live/pages/table_json_data.php?country=$this->country&type=country");
    }
    
    //-----
    
    //metodi GETTER - SETTER
    
    function getCountry() {
        return $this->country;
    }
    
    function setCountry( $country ) {
        $this->country = $country;
    }

}


?>
