<?php

    //credenziali di accesso al database
    include 'config/database.php';

    //data attuale
    $dateToShow = date("Y-m-d");

    //connessione al database mySql
    $conn = new mysqli($servername, $username, $password, $db );
          
    //chck della connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //check della data da mostrare, passata come parametro GET
    if( isset($_GET['date']) ) {
        if( $_GET['date'] <= date("Y-m-d") ) {
            $dateToShow = $_GET['date'];
        }
    }
    
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <!-- sistemare -->
    <link rel="icon" href="   ">
    <title>Covid-19 Data Tracker</title>
    <meta name="description"
        content="aggiornamenti, hai la possivilita' di scaricare tutti i dati messi a disposizione">
    <meta name="keywords" content="covid, coronavirus, emergenza, ecc">
    <!-- sistemare -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- import css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">



    <!-- import css -->

    <!--data picker-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!--data picker-->

    <!-- CSS splash screen -->
    <link rel="stylesheet" type="text/css" href="css/splash_screen.css">



</head>

<body>

    <div class="loader_bg">
        <div class="loader">

        </div>
    </div>


    <!-- custom scrollbar-->
    <style>
        body {
            height: 200vh;
        }

        body::-webkit-scrollbar {
            width: 0.6rem;
        }

        body::-webkit-scrollbar-track {
            /* background: rgb(233, 233, 233); */
        }

        body::-webkit-scrollbar-thumb {
            background: rgb(18, 148, 235);
            border-radius: 10px;
        }
    </style>
    <!-- custom scrollbar-->


    <!-- navbar --> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary dark_mode_object" id="nav">
        <img src="https://images.vexels.com/media/users/3/193114/isolated/preview/0be3590284a8dc5f1646b64816e2eb6e-covid-stop-badge-by-vexels.png"
            width="30" height="30" alt="Covid" loading="lazy">
        <a class="navbar-brand" href="#">COVID TRACKER 2020</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                <li class="nav-item">
                    <a class="nav-link" href="#">Map</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Contacts
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">email</a>
                        <a class="dropdown-item" href="#">about us</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else</a>
                    </div>
                </li>


            </ul>

            <div class="checkbox" style="width:15%;float:left;">
            <input  type="checkbox"
                    checked data-toggle="toggle" 
                    data-on="Light Mode" 
                    data-off="Dark Mode" 
                    data-onstyle="info" 
                    data-offstyle="dark"
                    data-style="border"
                    onChange="toggleDarkMode()">
            </div>

            
            <!-- <button type="button" class="btn btn-warning btn-sm mr-5" onclick="setDarkMode(true)">Try Dark Mode</button> -->

            <script type='text/javascript' src='https://ko-fi.com/widgets/widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#20e648', 'S6S41Y4BV');kofiwidget2.draw();</script> 
            </form>
        </div>
    </nav>
    <!-- navbar -->


    <div class="mt-2 messaggio" >
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <div class="alert alert-danger" role="alert"><p style="text-align: center;"><span style="font-size: 18pt;">We are constantly working to make this site better, <span style="color: #ff0000;"><a style="color: #ff0000;" title="skinnymonkeys7@gmail.com" href="mailto:skinnymonkeys7@gmail.com">contact us for suggestions</a></span></span></p> </div>
            </div>
            <div class="col-sm-6">
              <div class="alert alert-info" role="alert"><p style="text-align: center;"><span style="text-decoration: underline; color: #ff6600; font-size: 18pt;"><a style="color: #ff6600; text-decoration: underline;" title="Help us with a donation" href="https://ko-fi.com/skinnymonkeys" target="_blank" rel="noopener">∼ Support our project with a donation!</a></span></p></div>
            </div>
          </div>
        </div>
      </div>


    <!--prima riga-->
    <div class="primariga">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4" style="">
                    <!--Info generali-->
                    <div class="card text-white bg-primary mb-3" >
                        <div class="card-header">Header</div>
                        <div class="card-body bg-light dark_mode_object" id="info">
                          <!-- Titolo box info generali -->


                        
                        
                        <h1 class="card-title dark_mode_object" style="text-align:center"><img src="images/globe.png" alt="logo" width="50" height="50" />WORLD</h1>



                          
                          <h6 class="card-title" style="text-align:center">
                            <?php
                                echo $dateToShow;
                            ?>
                          </h6>
                          
                          <!-- Casi totali -->
                          <h1 class="card-title" style="text-align:center;font-weight: 800; color: rgb(230, 46, 0); font-size: 450%;">
                            <?php 
                                //creazione del testo della query
                                $sql = "SELECT total_cases ".
                                       "FROM covid_data ".
                                       "WHERE date = '$dateToShow' AND location = 'World'";
                                    
                                //esecuzione della query
                                echo $conn->query($sql)->fetch_assoc()["total_cases"];
                            ?>
                          </h1>
                          <p class="card-text" style="text-align:center"><small class="text-muted">Total cases</small></p>
                          <!-- Casi totali -->
                          <h1 class="card-title" style="text-align:center;font-weight: 800; color: rgb(77, 77, 255); font-size: 450%;">
                            <?php 
                                //creazione del testo della query
                                $sql = "SELECT new_cases ".
                                       "FROM covid_data ".
                                       "WHERE date = '$dateToShow' AND location = 'World'";
                                    
                                //esecuzione della query
                                echo $conn->query($sql)->fetch_assoc()["new_cases"];
                            ?>
                          </h1>
                          <p class="card-text" style="text-align:center"><small class="text-muted">New cases today</small></p>
                          <!-- Casi totali -->
                          <h1 class="card-title" style="text-align:center;font-weight: 800; color: rgb(77, 77, 77); font-size: 450%;">
                            <?php 
                                //creazione del testo della query
                                $sql = "SELECT total_deaths ".
                                       "FROM covid_data ".
                                       "WHERE date = '$dateToShow' AND location = 'World'";
                                    
                                //esecuzione della query
                                echo $conn->query($sql)->fetch_assoc()["total_deaths"];
                            ?>
                          </h1>
                          <p class="card-text" style="text-align:center"><small class="text-muted">Total deaths</small></p>
                          <!-- Casi totali -->
                          <h1 class="card-title" style="text-align:center;font-weight: 800; color: rgb(0, 0, 128); font-size: 450%;">
                            <?php 
                                //creazione del testo della query
                                $sql = "SELECT new_deaths ".
                                       "FROM covid_data ".
                                       "WHERE date = '$dateToShow' AND location = 'World'";
                                    
                                //esecuzione della query
                                echo $conn->query($sql)->fetch_assoc()["new_deaths"];
                            ?>
                          </h1>
                          <p class="card-text" style="text-align:center"><small class="text-muted">New deaths today</small></p>

                          <!-- Linea di divisione -->
                          <div class="mb-4">
                            <hr class="solid">
                          </div>
                          <style>
                            hr.solid {
                              border-top: 2px solid #999;
                            }
                          </style>

                          <!-- calendario -->
                          <h2 class="card-title" style="text-align:center;">Select date:</h2>
                          <div class="text-center"><input id = "flatpickr" align="center" placeholder="<?php echo $dateToShow ?>" style="text-align: center;"></div>
                          <script>
                            var example = flatpickr('#flatpickr',{

                            // Function(s) to trigger on every date selection. 
                            onChange: function(selectedDates, dateStr, instance) {
                                window.location.href = "./.?date="+encodeURI(dateStr);
                            },

                            // Function(s) to trigger on every time the calendar is closed.
                            onClose: null,

                            // Function(s) to trigger on every time the calendar is opened.
                            onOpen: null,

                            // Function to trigger when the calendar is ready.
                            onReady: null
                            
                            });
                          </script>

                        </div>
                      </div>
                    <!--Info generali-->

                    </div>

                    

                <!--prima dabella (Mondo)-->
                <div class="col-sm-8" style="">
                    <div class="card text-white bg-primary shadow-lg" >
                        <div class="card-header" id="header_mondo"><b>WORLD</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object"  id="body_mondo">

                            <table class="table table-striped "  id="Mondo" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow'";
                                        
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                        

                                        if ($result->num_rows > 0) {

                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                    
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                    
                                            }
                                        }

                                    ?>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
                <!--prima dabella (Mondo)-->
            </div>
        </div>
    </div>
    </div>
    <!--prima riga-->

    <!--seconda riga-->
    <div class="secondariga py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card text-white bg-danger shadow-lg" >
                        <div class="card-header" ><b>NORD AMERICA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_nord_america">

                            <!--seconda Tabella (nord  America)-->
                            <table class="table table-striped "  id="NordAmerica" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow' AND continent = 'North America'";
                                                    
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                    
                                
                                        if ($result->num_rows > 0) {
                                
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                
                                            }
                                        }
                                
                                    ?>
                                </tbody>
                            </table>
                            <!--seconda Tabella (nord America)-->
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="card text-white bg-danger shadow-lg" >
                        <div class="card-header"><b>SUD AMERICA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_sud_america">

                            <!--seconda Tabella (sud  America)-->
                            <table class="table table-striped "  id="SudAmerica" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow' and continent = 'South America'";
                                                    
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                    
                                
                                        if ($result->num_rows > 0) {
                                
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                
                                            }
                                        }
                                
                                    ?>
                                </tbody>
                            </table>
                            <!--terza dabella (sud America)-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--seconda riga-->

    <!--terza riga-->
    <div class=" riga py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-white bg-success shadow-lg" >
                        <div class="card-header"><b>EUROPA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_europa">

                            <!--seconda Tabella (sud  America)-->
                            <table class="table table-striped "  id="Europa" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow' AND continent='Europe'";
                                                    
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                    
                                
                                        if ($result->num_rows > 0) {
                                
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                
                                            }
                                        }
                                
                                    ?>
                                </tbody>
                            </table>
                            <!--Quarta tabella (Europa)-->

                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card text-white bg-success shadow-lg" >
                        <div class="card-header"><b>ASIA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_asia">
                          <!--Quinta tabella (Asia)-->
                           
                            <table class="table table-striped "  id="Asia" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                               
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow' AND continent = 'Asia'";
                                                    
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                    
                                
                                        if ($result->num_rows > 0) {
                                
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                
                                            }
                                        }
                                
                                    ?>
                                </tbody>
                            </table>
                            <!--Quinta tabella (Asia)-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--terza riga-->

    <!--quarta riga-->
    <div class=" riga py-3 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-white bg-warning shadow-lg" >
                        <div class="card-header"><b>AFRICA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_africa">

                            <!--seconda Tabella (sud  America)-->
                            <table class="table table-striped "  id="Africa" data-toggle="table" data-height="600" data-show-toggle="true"
                            data-detail-view="true" data-detail-view-icon="false"
                            data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                            data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                            data-search="true" data-search-align="left" data-sort-class="table-active"
                            data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                            data-click-to-select="true">
                            <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                            "FROM covid_data ".
                                            "WHERE date = '$dateToShow' AND continent = 'Africa'";
                                                    
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                    
                                
                                        if ($result->num_rows > 0) {
                                
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                
                                            }
                                        }
                                
                                    ?>
                                </tbody>
                            </table>
                            <!--seconda tabella (Africa)-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    
                    <div class="card text-white bg-warning shadow-lg" >
                        <div class="card-header"><b>OCEANIA</b></div>
                        <div class="card-body bg-light text-primary dark_mode_object" id="body_oceania">

                            <!--settima tabella (Oceania)-->
                            <table class="table table-striped "  id="Oceania" data-toggle="table" data-height="600" data-show-toggle="true"
                                data-detail-view="true" data-detail-view-icon="false"
                                data-detail-formatter="detailFormatter" data-header-style="headerStyle"
                                data-show-fullscreen="true" data-mobile-responsive="true" data-show-columns="true"
                                data-search="true" data-search-align="left" data-sort-class="table-active"
                                data-sortable="true" data-show-export="true" data-toolbar="#toolbar"
                                data-click-to-select="true">
                                <thead class="thead-dark">
                                    <tr>

                                        <th data-field="name" scope="col" data-sortable="true">NAME</th>
                                        <th data-field="confirmed" scope="col" data-sortable="true">CONFIRMED</th>
                                        <th data-field="changes1" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="deceased" scope="col" data-sortable="true">DECEASED</th>
                                        <th data-field="changes2" scope="col" data-sortable="true">CHANGES TODAY</th>
                                        <th data-field="tests" scope="col" data-sortable="true">TESTS</th>
                                        <th data-field="changes3" scope="col" data-sortable="true">CHANGES TODAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                        //creazione del testo della query
                                        $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                                                "FROM covid_data ".
                                                "WHERE date = '$dateToShow' AND continent = 'Oceania'";
                                                        
                                        //esecuzione della query
                                        $result = $conn->query($sql);
                                                        
                                    
                                        if ($result->num_rows > 0) {
                                    
                                            //per ogni record del risultato della query eseguita
                                            while($row = $result->fetch_assoc()) {
                                                    
                                                //crea una riga in tabella
                                                echo "<tr>";
                                                echo "<td>" . $row["location"] . "</td>";
                                                echo "<td>" . $row["total_cases"] . "</td>";
                                                echo "<td>↑ " . $row["new_cases"] . "</td>";
                                                echo "<td>" . $row["total_deaths"] . "</td>";
                                                echo "<td>↑ " . $row["new_deaths"] . "</td>";
                                                echo "<td>" . $row["total_tests"] . "</td>";
                                                echo "<td>↑ " . $row["new_tests"] . "</td>";
                                                echo "</tr>";		
                                                    
                                            }
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                            <!--settima tabella (Oceania)-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--quarta riga-->
  
    
    <!--footer-->
 <div class="footer">
    <div class="container-fluid py-5 shadow-lg border-danger bg-info">
      <div class="row shadow">
        <div class="p-4 col-md-3" style="">
          <h2 class="mb-4">COVID</h2>
          <p>nulla</p>
        </div>
        <div class="p-4 col-md-3 shadow-none">
          <h2 class="mb-4">Mapsite</h2>
          <ul class="list-unstyled"> <a href="#" class="text-dark">Home</a> <br> <a href="#" class="text-dark">map</a>
            <br> <a href="#" class="text-dark">contacts</a> <br> <a href="#" class="text-dark">about us</a>
          </ul>
        </div>
        <div class="p-4 col-md-3">
          <h2 class="mb-4">Contact</h2>
          <p contenteditable="true"> <a href="#" class="text-dark">
              <i class="fa d-inline mr-3 text-muted fa-envelope-o"></i>e</a>mail</p>
        </div>
        <div class="p-4 col-md-3 text-body">
          <h2 class="mb-4">Subscribe</h2>
          <form>
            <fieldset class="form-group"> <label for="exampleInputEmail1">Get our newsletter</label> <input type="email" class="form-control" placeholder="Enter email"> </fieldset> <button type="submit" class="btn       btn-outline-dark">Submit</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center">© Copyright <?php echo date("Y"); ?>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
    <!--footer riga-->



                            <!-- script per esportare i file delle tabelle -->
                            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

                            <script
                                src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                            <script
                                src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
                            <script
                                src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
                            <!-- script per esportare i file delle tabelle -->

                             <!-- scrip header-->
                             <script>
                                function headerStyle(column) {
                                    return {
                                        name: {
                                            classes: 'uppercase'
                                        },
                                        confirmed: {
                                            css: { color: 'red' }
                                        },
                                        changes1: {
                                            css: { background: '' }
                                        },
                                        deceased: {
                                            css: { color: 'red' }
                                        },
                                        changes2: {
                                            css: { background: '' }
                                        },
                                        tests: {
                                            css: { color: 'red' }
                                        },
                                        changes3: {
                                            css: { background: '' }
                                        }
                                    }[column.field]
                                }
                            </script>





                                <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
                            <link href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css"
                                rel="stylesheet">

                            <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
                            <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
                            <script
                                src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>

                            <script
                                src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

                            <script
                                src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>


                                <style>
                                .uppercase {
                                    text-transform: uppercase;
                                }
                            </style>

                            <!-- script switch -->
                            <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
                            <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
                            <!-- script switch -->








 <!-- full screen-->

                            <script>
                                window.icons = {

                                    fullscreen: 'ion-md-expand'
                                }
                            </script>
                            <!-- full screen-->




<!--data picker-->
    <script src = "https://cdn.jsdelivr.net/npm/flatpickr"> </script>
    <!--data picker-->


    <!--Import-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

    <!--Import-->


    <!--cookie managment (serve anche per la dark mode)-->
    <script src="js/cookie_managment.js"></script>

    <!-- gestione dark mode -->
    <script src="js/dark_mode.js"></script>

    <script>
        if( isDarkMode() ) {
            setDarkMode( true );
        }
    </script>





    <!--script splash screen-->
    <script>
        setTimeout(function () {
            $('.loader_bg').fadeToggle();
        }, 100);
    </script>
</body>
<!--script splash screen-->

</html>