<?php

include 'pages/date_managment.php';
include "/home/covid/resources/config.php";
include '/home/covid/resources/classes/table.php';
include '/home/covid/resources/classes/post_manager.php';
include '/home/covid/resources/classes/info_card.php';
include '/home/covid/resources/classes/math.php';

$months = monthsListFromDate("2020-01-01");
$dates = intervalsFromDate("2020-01-01", "months");

?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <?php include "/home/covid/resources/templates/head.php"; ?>
    <link rel='manifest' href='/manifest.json'>

</head>

<body>

    <?php
    include '/home/covid/resources/templates/navbar.php';
    ?>

<style>

@keyframes transition {

 from{
opacity: 0;
transform: rotateX(-10deg);

}
to {
    opacity: 3;
    transform: rotateX(0);

}

}

.container-fluid{
    animation: transition 0.75s;
    
    }
</style>

    <div class="container-fluid mt-2">
        <div class="row">


            <div class="col-xl-3 col-md-6 py-2">

                <?php
                InfoCard::TotalCases($COVID_DB_CONN, $DATE);
                ?>

            </div>

            <div class="col-xl-3 col-md-6 py-2">

                <?php
                InfoCard::NewCases($COVID_DB_CONN, $DATE);
                ?>
            </div>

            <div class="col-xl-3 col-md-6 py-2">

                <?php
                InfoCard::TotalDeaths($COVID_DB_CONN, $DATE);
                ?>
            </div>

            <div class="col-xl-3 col-md-6 py-2">
                <?php
                InfoCard::NewDeaths($COVID_DB_CONN, $DATE);
                ?>

            </div>
        </div>


        <div class="row">
            <div class="col-xl-7 col-lg-6 py-2">
                <div class="card zoom1 shadow text-white dark_mode_object  shadow-lg">

                    <div class="card-body">
                    <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row dark_mode_div">
                                        <p><i class="fas fa-bacterium fa-2x mr-3"></i><span class="font-weight-light h2">Total Cases</span></p>

                                    </div>
                                </div>
                                <div class="col-sm  text-right">
                                    <a href="https://www.covidtracker2020.live/pages/repository/" class="btn  btn-warning ml-2" role="button" >Download</a>
                                </div>
                            </div>
                        </div>

                    </div>

                       


                        <canvas id="cases_chart" height="400vh"></canvas>

                  
                </div>
            </div>
       

        <div class="col-xl-5 col-lg-6 py-2">
            <div class="card zoom1 shadow text-white dark_mode_object  shadow-lg">
                <div class="card-body">
                    <div class="float-left pl-4 dark_mode_div">
                        <p><i class="fas fa-biohazard fa-2x mr-3"></i><span class="font-weight-light h2">Total Deaths</span></p>
                    </div>
                </div>
                <canvas id="doughnutChart" height="400vh"></canvas>
            </div>

        </div>
    </div>




    <div class="row py-2">
        <div class="col-md-1 py-2">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Dashboard -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1084371123442891" data-ad-slot="8284967987" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

        <div class="col-md-11">
            <div class="card zoom1 shadow text-white bg-primary dark_mode_object  shadow-lg">

                <!-- Card Body -->
                <div class="card-body bg-light text-primary dark_mode_object border-bottom-primary" id="body_mondo">

                    <div class="container-fluid">
                        <div class="row">
                            <h2>WORLD</h2>

                        </div>

                    </div>

                    <?php
                    $table = new CountryListTable("World", $DATE);
                    $table->genTable();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $post_manager = new PostManager($WP_DB_CONN);
    $posts = $post_manager->randomPosts(3);
    ?>
    <div class="row py-2">

        <div class="col-lg-6 mb-4">

            <div class="card mb-3 dark_mode_object zoom1">
                <img src="<?php echo $posts[2]->getImage() ?>" class="card-img-top" alt="...">
                <div class="card-body dark_mode_div">
                    <h5 class="card-title font-weight-bold text-primary">
                        <a href="<?php echo str_replace("http", "https", $posts[2]->getUrl()); ?>">
                            <?php echo $posts[2]->getTitle() ?>
                        </a>
                    </h5>
                    <p class="card-text">
                        <?php echo mb_strimwidth($posts[2]->getContent(), 0, 600, "..."); ?>
                    </p>
                    <a href="<?php echo str_replace("http", "https", $posts[2]->getUrl()); ?>">Read more &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow dark_mode_object mb-4 zoom1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <a href="<?php echo str_replace("http", "https", $posts[0]->getUrl()); ?>">
                            <?php echo $posts[0]->getTitle() ?>
                        </a>
                    </h6>
                </div>
                <div class="card-body dark_mode_div">
                    <p>
                        <?php echo mb_strimwidth($posts[0]->getContent(), 0, 600, "..."); ?>
                    </p>
                    <a href="<?php echo str_replace("http", "https", $posts[0]->getUrl()); ?>">Read more &rarr;</a>
                </div>
            </div>

            <div class="card shadow dark_mode_object mb-4 zoom1">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <a href="<?php echo str_replace("http", "https", $posts[1]->getUrl()); ?>">
                            <?php echo $posts[1]->getTitle() ?>
                        </a>
                    </h6>
                </div>
                <div class="card-body dark_mode_div">
                    <p>
                        <?php echo mb_strimwidth($posts[1]->getContent(), 0, 600, "..."); ?>
                    </p>
                    <a href="<?php echo str_replace("http", "https", $posts[1]->getUrl()); ?>">Read more &rarr;</a>
                </div>
            </div>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle" style="display:block" data-ad-format="fluid" data-ad-layout-key="-h5-28-x-6z+xf" data-ad-client="ca-pub-1084371123442891" data-ad-slot="4154556835"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    </div>


    <?php
    include '/home/covid/resources/templates/footer.php';
    include '/home/covid/resources/templates/cookie-popup.php';
    ?>

    <script>
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
                datasets: [

                    <?php
                    $continents = array("Europe", "North America", "South America", "Africa", "Asia", "Oceania");
                    $rgba_colors = array("rgba(29, 140, 248, 0.09)", "rgba(220, 53, 70, 0.09)", "rgba(194, 48, 148, 0.09)", "rgba(40, 167, 68, 0.09)", "rgba(255, 204, 0, 0.09)", "rgba(255, 102, 0,0.09)");
                    $colors = array("#1d8cf8", "#dc3546", "#c23094", "#28a744", "#ffcc00", "#ff6600");
                    foreach ($continents as $current_continent) {
                    ?> {
                            label: "<?php echo $current_continent; ?>",
                            data: [<?php

                                    for ($i = 0; $i < count($dates); $i++) {
                                        echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data_" . str_replace(" ", "_", $current_continent) . " WHERE date = '" . $dates[$i] . "' ")->fetch_assoc()['total_cases'] . ",";
                                    }
                                    echo $COVID_DB_CONN->query("SELECT total_cases FROM covid_data_" . str_replace(" ", "_", $current_continent) . " WHERE date = '" . $DATE . "' ")->fetch_assoc()['total_cases'] . ",";

                                    ?>],
                            backgroundColor: <?php echo '"'.$rgba_colors[array_search($current_continent, $continents )].'"' ?>,
                            borderColor: [
                                <?php echo '"'.$colors[array_search($current_continent, $continents )].'"' ?>,
                            ],
                            borderWidth: 2,
                            pointBackgroundColor: <?php echo '"'.$colors[array_search($current_continent, $continents )].'"' ?>,
                        },
                    <?php } ?>
                ]
            },
            options: {

                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 0,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {

                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,

                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },

                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,

                }
            }
        });
    </script>




    <script>
        //doughnut
        var ctxD = document.getElementById("doughnutChart").getContext('2d');
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                    foreach ($continents as $continent) {
                        echo "'$continent',";
                    }
                    ?>
                ],
                datasets: [{
                    data: [
                        <?php
                        foreach ($continents as $continent) {
                            echo $COVID_DB_CONN->query("SELECT total_deaths FROM covid_data_" . str_replace(" ", "_", $continent) . " WHERE date = '$DATE'")->fetch_assoc()['total_deaths'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: ["#1d8cf8", "#dc3546", "#c23094", "#28a744", "#ffcc00", "#ff6600"]

                }]
            },
            options: {

                responsive: true
            },
            layout: {
                padding: {
                    left: 20,
                    right: 35,
                    top: 35,
                    bottom: 20
                }
            }
        });
    </script>


</body>

</html>