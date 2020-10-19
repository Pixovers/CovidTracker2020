<?php
include 'pages/date_managment.php';
include "/home/covid/resources/config.php";
include '/home/covid/resources/classes/table.php';
include '/home/covid/resources/classes/info_card.php';
include '/home/covid/resources/classes/math.php';
?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <?php include "/home/covid/resources/templates/head.php"; ?>
</head>

<body>
    <?php
    include '/home/covid/resources/templates/navbar.php';
    include '/home/covid/resources/templates/messages.html';
    ?>

    <!--prima riga-->
    <div class="primariga">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 py-2">
                    <div class="row">
                        <div class="col">
                            <h1>General</h1>
                        </div>
                        <div class="col text-right">
                            Data: <input class="ml-1 mt-3" id="flatpickr" placeholder="<?php echo $DATE; ?>" style="text-align: center;">
                        </div>
                        <script src="/js/datapicker.js"></script>
                    </div>



                    <div class="py-2">
                        <?php
                        InfoCard::TotalCases($COVID_DB_CONN, $DATE);
                        ?>
                    </div>

                    <div class="py-2">
                        <?php
                        InfoCard::NewCases($COVID_DB_CONN, $DATE);
                        ?>
                    </div>

                    <div class="py-2">

                        <?php
                        InfoCard::TotalDeaths($COVID_DB_CONN, $DATE);
                        ?>
                    </div>
                

                    <div class="py-2">
                                            <?php
                    InfoCard::NewDeaths($COVID_DB_CONN, $DATE);
                    ?>
                </div>

                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle" style="display:block" data-ad-format="fluid" data-ad-layout-key="-h5-28-x-6z+xf" data-ad-client="ca-pub-1084371123442891" data-ad-slot="4154556835"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>

            <!--prima tabella (Mondo)-->
            <div class="col-sm-8 py-2">
                <div class="card zoom shadow text-white bg-primary dark_mode_object  shadow-lg">
                    <div class="card-body bg-light text-primary dark_mode_object border-bottom-primary" id="body_mondo">
                        <h2>WORLD</h2>
                        <?php
                        $table = new CountryListTable("World", $DATE);
                        $table->genTable();
                        ?>
                    </div>
                </div>
            </div>
            <!--prima tabella (Mondo)-->
        </div>
    </div>
    </div>
    <!--prima riga-->

    <!--seconda riga-->
    <div class="secondariga py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 py-2">
                    <div class="card zoom shadow text-white text-danger  shadow-lg">
                        <div class="card-body bg-light text-danger border-bottom-danger dark_mode_object" id="body_nord_america">
                            <h2><a class="text-danger" href="https://www.covidtracker2020.live/pages/continents/?continent=North_America">NORTH AMERICA</a></h2>
                            <?php
                            $table = new CountryListTable("North America", $DATE);
                            $table->genTable();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 py-2">
                    <div class="card zoom shadow-lg">
                        <div class="card-body bg-light text-danger border-bottom-danger dark_mode_object" id="body_sud_america">
                            <h2><a class="text-danger" href="https://www.covidtracker2020.live/pages/continents/?continent=South_America">SOUTH AMERICA</a></h2>
                            <!--seconda Tabella (sud  America)-->
                            <?php
                            $table = new CountryListTable("South America", $DATE);
                            $table->genTable();
                            ?>
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
                <div class="col-md-6 py-2">
                    <div class="card zoom shadow-lg">
                        <div class="card-body bg-light border-bottom-success dark_mode_object" id="body_europa">
                            <h2><a class="text-success" href="https://www.covidtracker2020.live/pages/continents/?continent=Europe">Europe</a></h2>
                            <!--Quarta Tabella (Europa)-->
                            <?php
                            $table = new CountryListTable("Europe", $DATE);
                            $table->genTable();
                            ?>
                            <!--Quarta tabella (Europa)-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-2">
                    <div class="card zoom shadow-lg">
                        <div class="card-body bg-light border-bottom-secondary dark_mode_object" id="body_asia">
                            <h2><a class="text-secondary" href="https://www.covidtracker2020.live/pages/continents/?continent=Asia">Asia</a>
                            </h2>
                            <!--Quinta tabella (Asia)-->
                            <?php
                            $table = new CountryListTable("Asia", $DATE);
                            $table->genTable();
                            ?>
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
                <div class="col-md-6 py-2">
                    <div class="card zoom shadow-lg">
                        <div class="card-body bg-light border-bottom-info dark_mode_object" id="body_africa">
                            <h2><a class="text-info" href="https://www.covidtracker2020.live/pages/continents/?continent=Africa">Africa</a></h2>
                            <!--sesta tabella (Africa)-->
                            <?php
                            $table = new CountryListTable("Africa", $DATE);
                            $table->genTable();
                            ?>
                            <!--sesta tabella (Africa)-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-2">
                    <div class="card zoom shadow-lg">
                        <div class="card-body bg-light border-bottom-dark dark_mode_object" id="body_oceania">
                            <h2><a class="text-dark" href="https://www.covidtracker2020.live/pages/continents/?continent=Africa">Oceania</a></h2>
                            <!--settima tabella (Oceania)-->
                            <?php
                            $table = new CountryListTable("Oceania", $DATE);
                            $table->genTable();
                            ?>
                            <!--settima tabella (Oceania)-->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--quarta riga-->


    <?php
    include '/home/covid/resources/templates/footer.php';
    include '/home/covid/resources/templates/cookie-popup.php';
    ?>
</body>

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

</html>