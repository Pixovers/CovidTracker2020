<?php
    //credenziali di accesso al database
    include '../../config/database.php';
    
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    //connessione al database mySql
    $conn = new mysqli($servername, $username, $password, $db );
          
    //chck della connessione
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $locations = array( "United States", "Brazil", "India", "Russia", "South Africa", "Mexico", "Peru", "Chile", "United Kingdom", "Iran",
                        "Pakistan", "Saudi Arabia", "Colombia", "Italy", "Turkey", "Bangladesh", "Germany", "France" );


    include '../flags_managment.php';
    include '../counters_managment.php';

    $static_locations = getAllCountries($conn);

    
?>


    <!DOCTYPE html>
    <html>

    <head>
            <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173555806-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173555806-1');
    </script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
  <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>

  <script type="text/javascript" src="https://www.covidtracker2020.live/pages/map/jqvmap-master/dist/maps/jquery.vmap.world.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://www.covidtracker2020.live/pages/map/jqvmap-master/examples/js/jquery.vmap.sampledata.js"></script>

    </head>
    <?php
            include '/home/covid/resources/templates/navbar.php';
            include '/home/covid/resources/templates/messages.html';
        ?>
    <body class="fixed-sn dark-skin dark-theme">
    




        <div class="container-fluid ml-3">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <p class="h1 textWhite font-weight-bold">
                        <span class="text-success">COVID</span>
                        <span class="dark_mode_div">TRACKER2020</span>
                        <span class="text-danger">.LIVE</span>
                    </p>
                </div>
                <div class="col-xl-8 col-12">
                    <marquee behavior="scroll" direction="left" scrollamount="10">
                        <p class="h1 dark_mode_div">
                            How do we get this <span class="badge badge-danger">LIVE</span> data? find out on <span class="text-info">covidtracker2020.live</span>.
                        </p>
                    </marquee>
                </div>
            </div>
        </div>
        

       
        <!--div class="p-1"-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5">

                        <div class="row text-white text-center">
                            <div class="col-2"></div>
                            <div class="col"></div>
                            <div class="col">
                                <p class="h2 text-warning">Cases</p>
                            </div>
                            <div class="col">
                                <p class="h2 text-danger">Deceased</p>
                            </div>
                        </div>
                        <div class="row text-center dark_mode_div">
                            <div class="col-2"><img src="/images/globo.png" width="64"></div>
                            <div class="col">
                                <p class="h1">World</p>
                            </div>
                            <div class="col">
                                <p id="cases_World" class="h1">
                                    <?php echo getCurrentValue( $conn, "World", "total_cases", "new_cases" ); ?>
                                </p>
                            </div>
                            <div class="col">
                                <p id="deaths_World" class="h1">
                                    <?php echo getCurrentValue( $conn, "World", "total_deaths", "new_deaths" ); ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <hr class="solid">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body bg-dark">
                                <?php
                                    for( $i = 0; $i < count($GLOBALS['locations'] ); $i++ ) {
                                        echo '<div class="row text-center text-white">';
                                        echo '<div class="col-2"><img src="https://www.covidtracker2020.live/images/flags/' . CountryToIso($conn,$locations[$i]) . '.png" width="32"></div>';
                                        echo '<div class="col"><p class="h5">' . $locations[$i] . '</p></div>';
                                        echo '<div class="col"><p id="main_box_cases_'.$locations[$i].'" class="h5" style="color:rgb(255, 230, 179)">' . getCurrentValue( $conn, $locations[$i], "total_cases", "new_cases" ) . '</p></div>';
                                        echo '<div class="col"><p id="main_box_deaths_'.$locations[$i].'" class="h5" style="color:rgb(255, 153, 162)">' . getCurrentValue( $conn, $locations[$i], "total_deaths", "new_deaths" ) . '</p></div>';
                                        echo '</div>';
                                    }
                                ?>

                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body bg-dark">


                                <marquee behavior="scroll" direction="down" scrollamount="1" style="height:200px;">
                                    
                                    
                                    <?php
                                        $result = $conn->query("SELECT location, total_cases, total_deaths FROM covid_data ORDER BY date DESC LIMIT 209");
                                        while($row = $result->fetch_assoc()) {
                                            echo '<div class="row text-center text-white">';
                                            //echo '<div class="col-2"><img src="https://www.covidtracker2020.live/images/flags/' . CountryToIso($conn,$row['location']) . '.png" width="32"></div>';
                                            echo '<div class="col-2"></div>'; //flag placeholder
                                            echo '<div class="col"><p class="h5">' . $row['location'] . '</p></div>';
                                            echo '<div class="col"><p class="h5" style="color:rgb(255, 230, 179)">' . 
                                                 $row['total_cases'] .
                                                 '</p></div>';
                                            echo '<div class="col"><p class="h5" style="color:rgb(255, 153, 162)">' . 
                                                 $row['total_deaths'] .
                                                 '</p></div>';
                                            echo '</div>';
                                        }
                                    ?>

                                            


                                </marquee>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-7">
                        <div class="container-fluid">
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <div class="container-fluid">
                                                <div class="row text-center h3">
                                                    <div class="col"></div>
                                                    <div class="col">
                                                        <span class="text-warning">Cases</span>
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-danger">Deceased</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--marquee behavior="scroll" direction="right"> CIAO AMICIII </marquee-->
                                        </div>
                                        <div class="card-body bg-dark">
                                            <?php
                                            $continents = array( "Africa", "Europe", "Asia", "Oceania", "South America", "North America");

                                            for( $i = 0; $i < count( $continents ); $i++ ) {
                                                echo '<div class="row text-center text-white">';
                                               
                                                echo '<div class="col"><p class="h3">' . $continents[$i] . '</p></div>';
                                                echo '<div class="col"><p id="cases_'.$continents[$i].'" class="h3" style="color:rgb(255, 230, 179)">' . getCurrentValue( $conn, $continents[$i], "total_cases", "new_cases" ) . '</p></div>';
                                                echo '<div class="col"><p id="deaths_'.$continents[$i].'" class="h3" style="color:rgb(255, 153, 162)">' . getCurrentValue( $conn, $continents[$i], "total_deaths", "new_deaths" ) . '</p></div>';
                                                echo '</div>';
                                            }
                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                    <div class="col"> 
                                        <canvas id="labelChart"></canvas>
                                    </div>

                                </div>

                            <div class="col">
                              <div class="row" style="width:700px;">
                                <div class="col h-30">

                                <canvas id="lineChart"></canvas>
                               

                            </div >  
                          </div>
                             
                            </div>
                           
                          </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <!--/div-->
        <br><br><br><br>
    <?php
        include '/home/covid/resources/templates/footer.php';
    ?>
</body>
    <style>
      

      /*   .dark-theme.fixed-sn .double-nav,
  .dark-theme.fixed-sn main,
  .dark-theme.fixed-sn footer {
    padding-left: 15rem; } */
      .dark-theme.fixed-sn main {
        margin-left: 1rem;
        margin-right: 1rem;
      }

      @media (max-width: 1289px) {

        .dark-theme.fixed-sn .double-nav,
        .dark-theme.fixed-sn main,
        .dark-theme.fixed-sn footer {
          padding-left: 0;
        }
      }

      @media (min-width: 1289px) {
        .dark-theme.fixed-sn .double-nav .button-collapse {
          display: none;
        }
      }

      @media (max-width: 1289px) {
        .dark-theme.fixed-sn .double-nav .button-collapse {
          display: block;
          position: relative;
          font-size: 1.4rem;
          margin-right: 10px;
          margin-left: 10px;
        }
      }

      .dark-theme header {
        border-top: 2px solid #1d8cf8;
      }

      .dark-theme header .navbar {
        box-shadow: none;
        background-color: #181C30;
      }

      .dark-theme .card {
        background-color: #27293d;
      }

      .dark-theme .card .card-header {
        background-color: #27293d;
      }

      .dark-theme .card.card-table .card-header {
        border-bottom: none;
      }

      .dark-theme .btn.btn-sm {
        padding: .4rem 1.5rem .25rem;
        font-size: .75rem;
        font-weight: 500;
      }

      .dark-theme i.icon {
        font-size: 1.1rem;
      }

      .dark-theme i.icon.icon-blue {
        color: #36A2EB;
      }

      .cell-small {
        width: 1rem;
      }

      .dark-skin .side-nav .sidenav-bg:after,
      .dark-skin .side-nav .sidenav-bg.mask-strong:after {
        background: rgba(29, 140, 248, 0.8);
      }

      .dark-skin .side-nav .collapsible li .collapsible-header.active {
        background-color: rgba(24, 28, 48, 0.8);
      }

      .dark-skin .side-nav .collapsible li .collapsible-header:hover {
        background-color: rgba(24, 28, 48, 0.8);
      }

      .dark-skin .side-nav .collapsible li a:not(.collapsible-header):hover,
      .dark-skin .side-nav .collapsible li a:not(.collapsible-header).active,
      .dark-skin .side-nav .collapsible li a:not(.collapsible-header):active {
        color: #67d5ff !important;
      }
    </style>

        
        <style>
            body {
                background-color: rgb(21, 21, 21);
              
            }
            
            .h5 {
                font-size: 18px!important;
            }
            
            .textWhite {
                color: white;
            }
            
            hr.solid {
                border-top: 2px solid #999;
            }
            
            .vl {
                border-left: 6px solid green;
                height: 70%;
                position: absolute;
                left: 50%;
                margin-left: -3px;
                top: auto;
                down: auto;
            }
        </style>
        <script>
            <?php  

                
                for( $i = 0; $i < count($GLOBALS['locations'] ); $i++ ) {
                    echo 'counter("main_box_cases_' . $GLOBALS['locations'][$i] . '",' . 
                    strval(getCurrentDelay( $conn, $GLOBALS['locations'][$i], "new_cases" )) . 
                    ', document.getElementById("main_box_cases_' . $GLOBALS['locations'][$i] . '").innerHTML );';
                }

                for( $i = 0; $i < count($GLOBALS['locations'] ); $i++ ) {
                    echo 'counter("main_box_deaths_' . $GLOBALS['locations'][$i] . '",' . 
                    strval(getCurrentDelay( $conn, $GLOBALS['locations'][$i], "new_deaths" )) . 
                    ', document.getElementById("main_box_deaths_' . $GLOBALS['locations'][$i] . '").innerHTML );';
                }
                
                for( $i = 0; $i < count($continents ); $i++ ) {
                    echo 'counter("cases_' . $continents[$i] . '",' . 
                    strval(getCurrentDelay( $conn, $continents[$i], "new_cases" )) . 
                    ', document.getElementById("cases_' . $continents[$i] . '").innerHTML );';
                }

                for( $i = 0; $i < count($continents); $i++ ) {
                    echo 'counter("deaths_' . $continents[$i] . '",' . 
                    strval(getCurrentDelay( $conn, $continents[$i], "new_deaths" )) . 
                    ', document.getElementById("deaths_' . $continents[$i] . '").innerHTML );';
                }
            ?>

            counter( "cases_World", <?php echo getCurrentDelay( $conn, "World", "new_cases"); ?>, document.getElementById("cases_World").innerHTML );
            counter( "deaths_World", <?php echo getCurrentDelay( $conn, "World", "new_deaths"); ?>, document.getElementById("deaths_World").innerHTML );

            function counter( id, delay, start_val ) {
                function timer() {
                    start_val++;
                    document.getElementById(id).innerHTML = start_val;
                }
                var v = setInterval( timer, delay );
            }
        </script>




        <script>
            var ctxP = document.getElementById("labelChart").getContext('2d');
            var myPieChart = new Chart(ctxP, {
                plugins: [ChartDataLabels],
                type: 'pie',
                data: {
                    labels: ["North America", "South America", "Asia", "Europe", "Africa"],
                    datasets: [{
                        label: 'Total cases',
                        data: [
                            <?php
                                echo $conn->query("SELECT total_cases FROM covid_data_North_America ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_South_America ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Asia ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Europe ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Africa ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                        /*
                                echo getValueFromContinent( $conn, "North America", "total_cases" ) . ",";
                                echo getValueFromContinent( $conn, "South America", "total_cases" ) . ",";
                                echo getValueFromContinent( $conn, "Asia", "total_cases" ) . ",";
                                echo getValueFromContinent( $conn, "Europe", "total_cases" ) . ",";
                                echo getValueFromContinent( $conn, "Africa", "total_cases" );
                          */      
                            ?>
                        ],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'right',
                        labels: {
                            padding: 20,
                            boxWidth: 10
                        }
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            },
                            color: 'white',
                            labels: {
                                title: {
                                    font: {
                                        size: '16'
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>





        <script>
            //bar
            var ctxB = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(ctxB, {
                type: 'bar',
                data: {
                    labels: ["North America", "South America", "Asia", "Europe", "Africa", "Oceania"],
                    datasets: [{
                        label: 'Total cases',
                        data: [
                            <?php
                                echo $conn->query("SELECT total_cases FROM covid_data_North_America ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_South_America ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Asia ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Europe ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Africa ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                                echo $conn->query("SELECT total_cases FROM covid_data_Oceania ORDER BY date DESC ")->fetch_assoc()['total_cases'] . ",";
                            
                                
                            ?>
                            ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>


        <script>
//line
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
type: 'line',
data: {
labels: ["January", "February", "March", "April", "May", "June", "July", "August", "Today" ],
datasets: [{
label: "World Total Cases",
data: [   <?php
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-01-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-02-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-03-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-04-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-05-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-06-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-07-01' ")->fetch_assoc()['total_cases'] . ",";
            echo $conn->query("SELECT total_cases FROM covid_data WHERE location = 'World' AND date = '2020-07-01' ")->fetch_assoc()['total_cases'];
            
          ?>],
backgroundColor: [
'rgba(105, 0, 132, .2)',
],
borderColor: [
'rgba(200, 99, 132, .7)',
],
borderWidth: 2
},
{
label: "World Total Deaths",
data: [<?php
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-01-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-02-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-03-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-04-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-05-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-06-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-07-01' ")->fetch_assoc()['total_deaths'] . ",";
            echo $conn->query("SELECT total_deaths FROM covid_data WHERE location = 'World' AND date = '2020-07-01' ")->fetch_assoc()['total_deaths'];
            
          ?>],
backgroundColor: [
'rgba(0, 137, 132, .2)',
],
borderColor: [
'rgba(0, 10, 130, .7)',
],
borderWidth: 2
}
]
},
options: {
responsive: true
}
});

</script>



</html