<?php

include "/home/covid/resources/config.php";
include "/home/covid/resources/classes/counter.php";

//vettore nomi continenti 
$continents = array("Europe", "Asia", "North America", "South America", "Africa", "Oceania");

//array con i contatori per i continenti
$continents_counters = array();
foreach ($continents as $continent) {
    $continents_counters += array($continent => new CounterContinent($continent));
}

//contatore mondo
$world_counter = new CounterWorld();


?>


<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <?php include "/home/covid/resources/templates/head.php"; ?>
</head>

<body>

    <?php
    include '/home/covid/resources/templates/navbar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <p class="h1 ml-1 textWhite font-weight-bold py-0">
                    <span class="text-success">COVID</span>
                    <span class="dark_mode_div">TRACKER2020</span>
                    <span class="text-danger">.LIVE</span>
                    <span class="dark_mode_div"><i class="fas fa-shield-virus"></i></span>

                </p>
            </div>
            <div class="col-md-8">
                <marquee behavior="scroll" direction="right" scrollamount="10">
                    <p class="h1 dark_mode_div">
                        How do we get this <span class="badge badge-danger">LIVE</span> data? find out on <span class="text-info">covidtracker2020.live</span>.
                    </p>
                </marquee>
            </div>
        </div>
    </div>




    <div class="py-1">
        <div class="container-fluid">
            <div class="row">



                <!--generazione card-->
                <?php
                foreach ($continents as $continent) {
                ?>

                    <div class="col-lg-2 py-1">
                        <div class="card bg-dark zoom text-white">

                            <img src="https://www.covidtracker2020.live/images/previews/<?php echo strtolower(str_replace(" ", "_", $continent)); ?>.png" class="card-img-top" alt="Coronavirus <?php echo strtolower(str_replace(" ", "_", $continent)); ?>" title="Coronavirus <?php echo strtolower(str_replace(" ", "_", $continent)); ?>">
                            <div class="card-body text-center">
                                <p> <span class="h3"> <?php echo $continents_counters[$continent]->GetDOM("total_cases"); ?> </span> <i style="font-size:25px" class="fas fa-viruses  text-success"></i></p>

                                <p> <span class="h3"> <?php echo $continents_counters[$continent]->GetDOM("total_deaths"); ?> </span> <i style="font-size:25px" class="fas fa-skull-crossbones text-danger"></i> </p>
                            </div>
                        </div>
                    </div>

                <?php

                }
                ?>







            </div>
        </div>
    </div>






    <div class="py-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!--card mondo-->

                    <div class="card bg-dark zoom text-white">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://www.covidtracker2020.live/pages/blog/wp-content/uploads/2020/08/What-is-COVID-19-covidtracker2020.live_.png" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p> <span class="h3"> <?php echo $world_counter->GetDOM("total_cases"); ?> </span> <i style="font-size:25px" class="fas fa-viruses  text-success"></i></p>

                                    <p> <span class="h3"> <?php echo $world_counter->GetDOM("total_deaths"); ?> </span> <i style="font-size:25px" class="fas fa-skull-crossbones text-danger"></i> </p>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-md-8">

                    <div class="row py-1">
                        <marquee behavior="scroll" direction="right" scrollamount="3">
                            <p class="h1 dark_mode_div"> </p>
                        </marquee>
                    </div>
                    <div class="row py-1">
                        <marquee behavior="scroll" direction="left" scrollamount="3">
                            <p class="h1 dark_mode_div">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae magnam ducimus, id expedita libero sequi. Nulla dicta voluptatum, distinctio odio esse sequi a doloremque, ut optio quaerat rerum minus animi.</p>
                        </marquee>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">


            <?php
            $i = 0;
            $countries = array();

            $nations = $GLOBALS["COVID_DB_CONN"]->query("SELECT DISTINCT location, iso_code_a2 FROM covid_data cd INNER JOIN iso_table iso ON cd.iso_code = iso.iso_code_a3 WHERE location != 'World' AND date='" . $GLOBALS["DATE"] . "' ORDER BY new_cases  DESC LIMIT 40");

            while ($current = $nations->fetch_assoc()) {
                $countries += array($current["location"] => new CounterCountry($current["location"]));

                $i++;
            ?>

                <div class="col-md-3 py-1">

                    <div class="card bg-dark text-white shadow zoom">

                        <div class="row">
                            <div class="col-2">
                                <div class="info-icon icon-primary">
                                    <img src="https://www.covidtracker2020.live/images/flags/<?php echo $current["iso_code_a2"]; ?>.png" class="card-img " alt="...">
                                </div>
                            </div>
                            <div class="col-6 ">
                                <span style="font-size:20px"> <?php echo substr($current["location"], 0, 15); ?> </span>

                            </div>

                            <div class="col-3 py-1">
                                <span class="ml-1 h4"> #<?php echo $i ?> </span>

                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-6 text-center py-1">
                                <span class="h4"> <?php echo $countries[$current["location"]]->GetDOM( "total_cases" ); ?> </span> <i style="font-size:20px" class="fas fa-viruses  text-success"></i>

                            </div>
                            <div class="col-6 text-center py-1">
                                <span class="h4"><?php echo $countries[$current["location"]]->GetDOM( "total_deaths" ); ?> <?php  ?> </span> <i style="font-size:20px" class="fas fa-skull-crossbones  text-danger"></i>

                            </div>
                        </div>

                    </div>

                </div>
            <?php
            }
            ?>
        </div>
    </div>





    <?php
    include '/home/covid/resources/templates/footer.php';
    include '/home/covid/resources/templates/cookie-popup.php';
    ?>


    <script>
        <?php
        //script contatori continenti
        foreach ($continents as $continent) {
            echo $continents_counters[$continent]->GetJS( "total_cases" );
            echo $continents_counters[$continent]->GetJS( "total_deaths" );
        }

        //script contatore mondo
        echo $world_counter->GetJS("total_cases");
        echo $world_counter->GetJS("total_deaths");

        foreach ($countries as $country) {
            echo $country->GetJS( "total_cases" );
            echo $country->GetJS( "total_deaths" );
        }

        ?>

        function counter(id, delay, start_val) {
            function timer() {
                start_val++;
                document.getElementById(id).innerHTML = start_val;
            }
            var v = setInterval(timer, delay);
        }
    </script>
</body>
