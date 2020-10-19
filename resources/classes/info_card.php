<?php

/*
     *      Classe:         InfoCard
     *      Descrizione:    Gestione e implementazoni delle card con le info generali
     */
class InfoCard
{

    //card con i TotalCases
    public static function TotalCases($connection, $date)
    {
?>
        <div class="card border-info dark_mode_object shadow h-100 py-2 zoom">
            <div class="card-body">
                <div class="row">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Cases</div>
                        <div class="h5 mb-0 font-weight-bold dark_mode_div ">
                            <?php
                            //creazione del testo della query
                            $sql =  "SELECT total_cases " .
                                "FROM covid_data " .
                                "WHERE date = '$date' AND location = 'World'";

                            //esecuzione della query
                            echo $connection->query($sql)->fetch_assoc()["total_cases"];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-head-side-cough fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    //card con i NewCases
    public static function NewCases($connection, $date)
    {
    ?>
        <div class="card border-success dark_mode_object shadow h-100 py-2 zoom">
            <div class="card-body">
                <div class="row">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">New Cases</div>
                        <div class="h5 mb-0 font-weight-bold dark_mode_div">
                            <?php
                            //creazione del testo della query
                            $sql = "SELECT new_cases " .
                                "FROM covid_data " .
                                "WHERE date = '$date' AND location = 'World'";

                            //esecuzione della query
                            $v1 =  $connection->query($sql)->fetch_assoc()["new_cases"];
                            echo $v1;
                            ?> <em class="ml-1 ">
                                <?php
                                //creazione del testo della query
                                $sql =  "SELECT new_cases " .
                                    "FROM covid_data " .
                                    "WHERE date = '" . date('Y-m-d', strtotime('-1 day', strtotime($date))) . "' AND location = 'World'";

                                //esecuzione della query
                                $v2 =  $connection->query($sql)->fetch_assoc()["new_cases"];
                                if( Math::percentageVariation($v2, $v1, 0) >= 0 ) {
                                    echo "+";
                                }
                                echo Math::percentageVariation($v2, $v1, 0) . "%";
                                ?>
                            </em>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-viruses fa-2x text-success"></i>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    //card con i TotalDeaths
    public static function TotalDeaths($connection, $date)
    {
    ?>
        <div class="card border-danger dark_mode_object shadow h-100 py-2 zoom">
            <div class="card-body">
                <div class="row">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">total Deaths</div>
                        <div class="h5 mb-0 font-weight-bold dark_mode_div">
                            <?php
                            //creazione del testo della query
                            $sql = "SELECT total_deaths " .
                                "FROM covid_data " .
                                "WHERE date = '$date' AND location = 'World'";

                            //esecuzione della query
                            echo $connection->query($sql)->fetch_assoc()["total_deaths"];
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-skull-crossbones fa-2x text-danger"></i>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    //card con i NewDeaths
    public static function  NewDeaths($connection, $date)
    {
    ?>
        <div class="card border-warning dark_mode_object shadow h-100 py-2 zoom">
            <div class="card-body">
                <div class="row">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">New Deaths</div>
                        <div class="h5 mb-0 font-weight-bold dark_mode_div">
                            <?php
                            //creazione del testo della query
                            $sql = "SELECT new_deaths " .
                                "FROM covid_data " .
                                "WHERE date = '$date' AND location = 'World'";

                            //esecuzione della query
                            $v1 = $connection->query($sql)->fetch_assoc()["new_deaths"];
                            echo $v1;
                            ?> <em class="ml-1 ">
                                <?php
                                //creazione del testo della query
                                $sql =  "SELECT new_deaths " .
                                    "FROM covid_data " .
                                    "WHERE date = '" . date('Y-m-d', strtotime('-1 day', strtotime($date))) . "' AND location = 'World'";

                                //esecuzione della query
                                $v2 =  $connection->query($sql)->fetch_assoc()["new_deaths"];
                                if( Math::percentageVariation($v2, $v1, 0) >= 0 ) {
                                    echo "+";
                                }
                                echo Math::percentageVariation($v2, $v1, 0) . "%";
                                ?>
                            </em>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ambulance fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

?>