<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "/home/covid/resources/config.php";
include '/home/covid/resources/classes/table.php';

include "../date_managment.php";
include "../flags_managment.php";


$months = monthsListFromDate("2020-01-01");
$dates = intervalsFromDate( "2020-01-01", "months" );


?>


<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
    <head>
        <?php include "/home/covid/resources/templates/head.php"; ?>
<script>
    var sample = {
        <?php

        echo file_get_contents("../../config/world_map_colors.dat");

        ?>
    };

    var data = [
        <?php

        echo file_get_contents("../../config/world_map_data.dat");
        ?>
    ]
</script>

<script>
    jQuery(document).ready(function() {
        jQuery('#vmap').vectorMap({
            map: '<?php echo strtolower(str_replace(" ", "-", $chosen_continent)); ?>_en',
            backgroundColor: '#181C30',
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            scaleColors: ['#FFFFFF', '#66ccff', '#000099'],
            values: sample,
            normalizeFunction: 'polynomial',
            onLabelShow: function(event, label, code) {


                function checkCode(code_value) {
                    return code == code_value[0];
                }
                //console.log( data.find(checkCode));

                //vettore fina
                country = data.find(checkCode);
                if (typeof country !== 'undefined') {
                    // HTML Based Labels. You can use any HTML you want, this is just an example
                    label.html('<div class="col py-2">' +
                        ' <img  class="h4 d-block mx-auto rounded" height="40px" src="https://www.covidtracker2020.live/images/flags/' + code + '.png" alt=""> </img>' +
                        '<div class="title text-center h5"> ' + country[1] + ' </div>' +
                        '<table>' +
                        '<tbody>' +
                        '<tr>' +

                        '<td>  <span class="deaths text-warning">' + 'Total cases: ' + country[2] + ' </span></td>' +
                        '</tr>' +
                        '<tr>' +

                        '<td><span class="critical  text-danger">' + 'New cases: ' + country[3] + '</span></td>' +
                        '</tr>' +
                        '<tr>' +

                        '<td><span class="active primary text-success">' + 'Total Deaths: ' + country[4] + '</span></td>' +
                        '</tr>' +
                        '<tr>' +

                        '<td><span class="recovered danger text-primary">' + 'New Deaths: ' + country[5] + '</span></td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>'
                    );
                }

            },
        });





        //Do something when the map is dragged
        jQuery('#vmap').on('drag', function(event) {
            console.log('The map is being dragged');
            event.preventDefault();
        });
    });
</script>
</head>

<body class="fixed-sn dark-skin dark-theme">

    <?php
    include '/home/covid/resources/templates/navbar.php';
    include '/home/covid/resources/templates/messages.html';
    ?>

    <div class="dark_mode_div">
        <marquee behavior="scroll" direction="right">
            <div class="dark_mode_div">
                <h1><?php echo $chosen_continent; ?></h1>
            </div>
        </marquee>
    </div>












    <div class="container-fluid mt-3">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                        <div class="card-header bg-light dark_mode_object" role="tab" id="headingOne1 ">
                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1 ">
                                <h5 class="mb-0">
                                    Hide Map <i class="fas fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx" aria-expanded="false">
                            <div class="card-body">
                                <div id="vmap" style="height:calc(70vh - 40px);"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                    <div class="card-body">
                        <div class="float-left pl-4 dark_mode_div">
                            <p><i class="fas fa-biohazard fa-2x mr-3"></i><span class="font-weight-light h2">Total Cases</span></p>
                            <p class="font-weight-light mb-1 mt-n1 font-small ml-5"> <?php echo $chosen_continent; ?> total cases month by month. </p>
                        </div>
                        <canvas id="cases_chart" height="200"></canvas>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 mb-4">

                <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                    <div class="card-body">
                        <div class="float-left pl-4 dark_mode_div">
                            <p><i class="fas fa-biohazard fa-2x mr-3"></i><span class="font-weight-light h2">Total Deaths</span></p>
                            <p class="font-weight-light mb-1 mt-n1 font-small ml-5"> <?php echo $chosen_continent; ?> total deceased month by month. </p>
                        </div>
                        <canvas id="deaths_chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class=" card border-info dark_mode_object shadow h-100 py-2 zoom">
                    <div class="card-body">
                        <div class="float-left pl-4 dark_mode_div">
                            <p><i class="fas fa-bacterium fa-2x mr-3"></i><span class="font-weight-light h2">New Cases Everyday</span></p>
                            <p class="font-weight-light mb-1 mt-n1 font-small ml-5"> <?php echo $chosen_continent; ?> daily average of new cases month by month. </p>
                        </div>
                        <canvas id="chart_1" height="250"></canvas>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                    <div class="card-body">
                        <div class="float-left pl-4 dark_mode_div">
                            <p><i class="fas fa-calendar-alt fa-2x mr-3"></i><span class="font-weight-light h2">Week Summary</span></p>
                            <p class="font-weight-light mb-1 mt-n1 font-small ml-5"> <?php echo $chosen_continent; ?> brief summary of last 7 days.</p>
                        </div>
                        <canvas id="chart_2" height="250"></canvas>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                    <div class="card-body">
                        <div class="float-left pl-4 dark_mode_div">

                            <p><i class="fas fa-bacteria fa-2x mr-3"></i><span class="font-weight-light h2">New Deaths Everyday</span></p>
                            <p class="font-weight-light mb-1 mt-n1 font-small ml-5"> <?php echo $chosen_continent; ?> daily average of new deceased month by month. </p>
                        </div>
                        <canvas id="chart_3" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>





        <div class="row mb-4">
            <div class="col-md-12">
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
                        <div class="card-header" role="tab" id="headingOne1 ">
                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2 ">
                                <h5 class="mb-0">
                                    Hide Table <i class="fas fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx" aria-expanded="false">
                            <div class="card-body">
                                <?php
                                $table = new CountryListTable($chosen_continent, $DATE);
                                $table->genTable();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '/home/covid/resources/templates/footer.php';
    //include '/home/covid/resources/templates/cookie-popup.php';
    ?>

    <script>
        var $table = $('#table')

        $(function() {
            $table.bootstrapTable()
        })
    </script>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- script header-->
    <script>
        function headerStyle(column) {
            return {
                name: {
                    classes: 'uppercase'
                },
                confirmed: {
                    css: {
                        color: 'red'
                    }
                },
                changes1: {
                    css: {
                        background: ''
                    }
                },
                deceased: {
                    css: {
                        color: 'red'
                    }
                },
                changes2: {
                    css: {
                        background: ''
                    }
                },
                tests: {
                    css: {
                        color: 'red'
                    }
                },
                changes3: {
                    css: {
                        background: ''
                    }
                }
            } [column.field]
        }
    </script>



    <script>
        var $table = $('#table')

        $(function() {
            $('#toolbar').find('select').change(function() {
                $table.bootstrapTable('destroy').bootstrapTable({
                    exportDataType: $(this).val(),
                    exportTypes: ['pdf', 'png', 'doc', 'excel', 'xlsx', 'json', 'xml', 'csv', 'txt', 'sql']


                })
            }).trigger('change')
        })
    </script>


    <script>
        $(document).ready(function() {
            // SideNav Button Initialization
            $(".button-collapse").sideNav({
                slim: true,
            });
            // SideNav Scrollbar Initialization
            var sideNavScrollbar = document.querySelector('.custom-scrollbar');
            var ps = new PerfectScrollbar(sideNavScrollbar);
        });


        // Line
        var ctx_cases_chart = document.getElementById("cases_chart").getContext('2d');
        var gradientFill = ctx_cases_chart.createLinearGradient(0, 0, 0, 250);
        gradientFill.addColorStop(0, "rgba(0, 140, 248, 1)");
        gradientFill.addColorStop(1, "rgba(29, 140, 248, 0.1)");
        var cases_chart_var = new Chart(ctx_cases_chart, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    foreach ($months as $month) {
                        echo '"' . $month . '",';
                    }
                    echo '"Today"';
                    ?>
                ],
                datasets: [{
                    label: "World Total Cases",
                    data: [<?php
                            if ($chosen_continent == "world") {
                                foreach ($dates as $date) {
                                    echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data WHERE location = 'world' AND date = '$date' ")->fetch_assoc()['total_cases'] . ",";
                                }
                                echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d") . "' ")->fetch_assoc()['total_cases'] . ",";
                            } else {
                                for ($i = 0; $i < count($dates); $i++) {
                                    echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . $dates[$i] . "' ")->fetch_assoc()['total_cases'] . ",";
                                }
                                echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d") . "' ")->fetch_assoc()['total_cases'] . ",";
                            }

                            ?>],
                    backgroundColor: gradientFill,
                    borderColor: [
                        '#1d8cf8',
                    ],
                    borderWidth: 2,
                    pointBackgroundColor: "#1d8cf8",
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            padding: 0,
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        },
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
        });

        var ctx_deaths_chart = document.getElementById("deaths_chart").getContext('2d');
        var gradientFill = ctx_deaths_chart.createLinearGradient(0, 0, 0, 250);
        gradientFill.addColorStop(0, "rgba(245, 85, 74, 1)");
        gradientFill.addColorStop(1, "rgba(245, 85, 74, 0.1)");
        var deaths_chart_var = new Chart(ctx_deaths_chart, {
            type: 'line',
            data: {
                labels: [
                    <?php
                    foreach ($months as $month) {
                        echo '"' . $month . '",';
                    }
                    echo '"Today"';
                    ?>
                ],
                datasets: [{
                    label: "World Total Cases",
                    data: [<?php
                            if ($chosen_continent == "world") {
                                foreach ($dates as $date) {
                                    echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data WHERE location = 'world' AND date = '$date' ")->fetch_assoc()['total_deaths'] . ",";
                                }
                                echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d") . "' ")->fetch_assoc()['total_deaths'] . ",";
                            } else {
                                foreach ($dates as $date) {
                                    echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . $date . "' ")->fetch_assoc()['total_deaths'] . ",";
                                }
                                echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d") . "' ")->fetch_assoc()['total_deaths'] . ",";
                            }
                            ?>],
                    backgroundColor: gradientFill,
                    borderColor: [
                        '#f5554a',
                    ],
                    borderWidth: 2,
                    pointBackgroundColor: "#f5554a",
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: 'rgba(245, 85, 74, .5)',
                            fontStyle: 'bold',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            padding: 0,
                            fontColor: 'rgba(245, 85, 74, .5)',
                            fontStyle: 'bold',
                        },
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
        });


        var ctx_chart_1 = document.getElementById("chart_1").getContext('2d');

        var chart_2_var = new Chart(ctx_chart_1, {
            type: "horizontalBar",
            data: {
                labels: [<?php
                            foreach ($months as $month) {
                                echo '"' . $month . '",';
                            }
                            echo '"Today"';
                            ?>],
                datasets: [{
                    data: [
                        <?php
                        if ($chosen_continent == "world") {
                            foreach ($dates as $date) {
                                $value = intval($COVID_DB_CONN->query("SELECT new_cases FROM covid_data WHERE location = 'world' AND date = '$date' ")->fetch_assoc()['new_cases']);
                                $value += intval($COVID_DB_CONN->query("SELECT new_cases FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime($date . " +5 days")) . "' ")->fetch_assoc()['new_cases']);
                                $value += intval($COVID_DB_CONN->query("SELECT new_cases FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime($date . " +10 days")) . "' ")->fetch_assoc()['new_cases']);

                                echo intval($value / 3) . ",";
                            }
                            echo $COVID_DB_CONN->query("SELECT new_cases FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d") . "' ")->fetch_assoc()['new_cases'];
                        } else {
                            foreach ($dates as $date) {
                                echo $COVID_DB_CONN->query("SELECT new_cases FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . $date . "' ")->fetch_assoc()['new_cases'] . ",";
                            }
                            echo $COVID_DB_CONN->query("SELECT new_cases FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d") . "' ")->fetch_assoc()['new_cases'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(0, 128, 255, .5)',
                    borderColor: 'rgba(0, 128, 255, .1)',
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: false,
                            min: 0,

                            padding: 0,
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        },
                    }]
                }
            }
        });
        // Line2
        var ctx_chart_2 = document.getElementById("chart_2").getContext('2d');
        var gradientFill1 = ctx_chart_2.createLinearGradient(0, 0, 0, 250);
        gradientFill1.addColorStop(0, "rgba(29, 140, 248, 1)");
        gradientFill1.addColorStop(1, "rgba(29, 140, 248, 0.1)");
        var gradientFill2 = ctx_chart_2.createLinearGradient(0, 0, 0, 500);
        gradientFill2.addColorStop(0, "rgba(245, 85, 74, 1)");
        gradientFill2.addColorStop(1, "rgba(245, 85, 74, 0.1)");
        var chart_2_var = new Chart(ctx_chart_2, {
            type: 'line',
            data: {
                labels: [<?php

                            for ($i = 7; $i > 0; $i--) {
                                echo '"-' . $i . ' Days",';
                            }
                            echo '"Today"';
                            ?>],

                datasets: [{
                    label: "Total Deceased",
                    data: [<?php
                            if ($chosen_continent == "world") {
                                for ($i = 7; $i >= 0; $i--) {
                                    echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime(date("Y-m-d") . " -" . $i . " days")) . "' ")->fetch_assoc()['total_deaths'] . ",";
                                }
                            } else {
                                for ($i = 7; $i >= 0; $i--) {
                                    //echo getValueFromContinent( $COVID_DB_CONN, $chosen_continent, "total_deaths", date( "Y-m-d", strtotime(date("Y-m-d")." -".$i." days")) ) . ",";
                                    echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d", strtotime(date("Y-m-d") . " -" . $i . " days")) . "' ")->fetch_assoc()['total_deaths'] . ",";
                                }
                            }
                            ?>],
                    backgroundColor: gradientFill2,
                    borderColor: [
                        '#f5554a',
                    ],
                    borderWidth: 2,
                    pointBackgroundColor: "#f5554a",
                }, {
                    label: "Total Cases",
                    data: [<?php
                            if ($chosen_continent == "world") {
                                for ($i = 7; $i >= 0; $i--) {
                                    echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime(date("Y-m-d") . " -" . $i . " days")) . "' ")->fetch_assoc()['total_cases'] . ",";
                                }
                            } else {
                                for ($i = 7; $i >= 0; $i--) {
                                    echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d", strtotime(date("Y-m-d") . " -" . $i . " days")) . "' ")->fetch_assoc()['total_cases'] . ",";
                                }
                            }
                            ?>],
                    backgroundColor: gradientFill1,
                    borderColor: [
                        '#1d8cf8',
                    ],
                    borderWidth: 2,
                    pointBackgroundColor: "#1d8cf8",
                }]
            },
            options: {
                legend: {
                    display: true,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            min: 0,
                            padding: 0,
                            fontColor: 'rgba(0, 128, 255, .5)',
                            fontStyle: 'bold',
                        },
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
        });
        // Bar
        var ctx_chart_3 = document.getElementById("chart_3").getContext('2d');
        var chart_3_var = new Chart(ctx_chart_3, {
            type: 'bar',
            data: {
                labels: [<?php
                            foreach ($months as $month) {
                                echo '"' . $month . '",';
                            }
                            echo '"Today"';
                            ?>],
                datasets: [{
                    data: [
                        <?php
                        if ($chosen_continent == "world") {
                            foreach ($dates as $date) {
                                $value = intval($COVID_DB_CONN->query("SELECT new_deaths FROM covid_data WHERE location = 'world' AND date = '$date' ")->fetch_assoc()['new_deaths']);
                                $value += intval($COVID_DB_CONN->query("SELECT new_deaths FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime($date . " +5 days")) . "' ")->fetch_assoc()['new_deaths']);
                                $value += intval($COVID_DB_CONN->query("SELECT new_deaths FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d", strtotime($date . " +10 days")) . "' ")->fetch_assoc()['new_deaths']);

                                echo intval($value / 3) . ",";
                            }
                            echo $COVID_DB_CONN->query("SELECT new_deaths FROM covid_data WHERE location = 'world' AND date = '" . date("Y-m-d") . "' ")->fetch_assoc()['new_deaths'];
                        } else {
                            foreach ($dates as $date) {
                                echo $COVID_DB_CONN->query("SELECT new_deaths FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . $date . "' ")->fetch_assoc()['new_deaths'] . ",";
                            }
                            echo $COVID_DB_CONN->query("SELECT new_deaths FROM covid_data_" . str_replace(" ", "_", $chosen_continent) . " WHERE date = '" . date("Y-m-d") . "' ")->fetch_assoc()['new_deaths'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(245, 85, 74, 0.6)',
                    borderColor: 'rgba(245, 85, 74, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: 'rgba(245, 85, 74, .5)',
                            fontStyle: 'bold',

                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'rgba(245, 85, 74, .5)',
                            fontStyle: 'bold'
                        }
                    }]
                }
            }
        });
    </script>




    <!--IMPORT-->





    <!--Booststrap-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!--TableImport-->
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"> </script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/print/bootstrap-table-print.min.js"></script>

    <!--TableImport-->
    <!--Booststrap-->


</body>


</html>