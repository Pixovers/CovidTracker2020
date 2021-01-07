<?php


include "/home/covid/resources/config.php";
include "/home/covid/resources/classes/counter.php";

$start = microtime(true);

$countries = array();

$nations = $GLOBALS["COVID_DB_CONN"]->query("SELECT DISTINCT location FROM covid_data WHERE date='".$GLOBALS["DATE"]."' ORDER BY new_cases DESC");
while( $current = $nations->fetch_assoc() ) {
        $countries += array( $current["location"] => new Counter($current["location"]));
}

$continents = array( "Africa", "Europe", "Asia", "Oceania", "South America", "North America");
foreach( $continents as $continent ) {
    $countries += array( $continent => new Counter($continent));
}

foreach($countries as $name => $counter) {
    echo $name."   ";
    $counter->printCasesDOM();
    echo "   ";
    $counter->printDeathsDOM();
    echo "<br>";
}


$total = microtime(true) - $start;
echo $total;

?>



<script>
<?php
	    foreach($countries as $name => $counter) {
            echo $counter->printCasesJS();
            echo $counter->printDeathsJS();
        }
?>		



		function counter( id, delay, start_val ) {
            function timer() {
                start_val++;
                document.getElementById(id).innerHTML = start_val;
            }
            var v = setInterval( timer, delay );
        }
</script>