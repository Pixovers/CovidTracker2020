<?php

class Import
{
    public static function Bootstrap_Table()
    {
?>

        <!-- Bootstrap Table -->
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
        <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
    <?php
    }

    public static function Bootstrap_Table_Export()
    {
    ?>

        <!-- Bootstrap Table Exports -->
        <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>
        <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
        <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
        <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/print/bootstrap-table-print.min.js"></script>

    <?php
    }

    public static function Map()
    {
    ?>

        <!-- Map -->
        <script type="text/javascript" src="/js/jqvmap/jquery.vmap.min.js"></script>
        <link href="/stylesheet/jqvmap/jqvmap.min.css" media="screen" rel="stylesheet" type="text/css" />
        <?php if (isset($GLOBALS['chosen_continent'])) { ?>
            <script type="text/javascript" src="/js/jqvmap/maps/jquery.vmap.<?php echo strtolower(str_replace(" ", "-", $GLOBALS['chosen_continent'])); ?>.js" charset="utf-8"></script>
        <?php
        } else {
        ?>
            <script type="text/javascript" src="/js/jqvmap/maps/jquery.vmap.world.js" charset="utf-8"></script>
        <?php
        }
    }

    public static function ItalyMap()
    {
        ?>
        <script type="text/javascript" src="https://www.covidtracker2020.live/js/jqvmap/jquery.vmap.min.js"></script>
        <link href="https://www.covidtracker2020.live/stylesheet/jqvmap/jqvmap.min.css" media="screen" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://it.covidtracker2020.live/js/map/jquery.vmap.italia.js" charset="utf-8"></script>
    <?php
    }

    public static function Bootstrap_Charts()
    {
    ?>

        <!-- Bootstrap Charts -->
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.6.0/js/mdb.min.js"></script>
    <?php
    }

    public static function DataPicker()
    {
    ?>

        <!-- Data Picker -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" as="style">

<?php
        //<script src="/js/datapicker.js"></script>
    }

    public static function gtag() {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173555806-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-173555806-1');
        </script>

        <?php
    }

    public static function it_gtag() {
        ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8GD7284FPY"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8GD7284FPY');
        </script>
        <?php
    }
}


?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>



<script src="https://kit.fontawesome.com/f458f3684b.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://www.covidtracker2020.live/stylesheet/zoom.css">
<link rel="stylesheet" href="https://www.covidtracker2020.live/stylesheet/scrollbar.css">
<link rel="stylesheet" href="https://www.covidtracker2020.live/stylesheet/cookie.css">
<link rel="stylesheet" type="text/css" href="https://it.covidtracker2020.live/css/fade.css">


<?php

switch ($CURRENT_PAGE) {
    case "Repository":
        Import::Bootstrap_Table();
        Import::DataPicker();
        Import::Bootstrap_Table_Export();
        Import::gtag();
        break;

    case "Dashboard":
        Import::Bootstrap_Table();
        Import::Bootstrap_Charts();
        Import::gtag();
        break;

    case "Countries":
        Import::Bootstrap_Table();
        Import::Bootstrap_Charts();
        Import::Map();
        Import::gtag();
        break;

    case "Continents":
        Import::Bootstrap_Table();
        Import::Bootstrap_Charts();
        Import::Map();
        Import::gtag();
        break;

    case "Map":
        Import::Map();
        Import::gtag();
        break;

    case "it-Home":
        Import::it_gtag();
        Import::Bootstrap_Table();
        Import::Bootstrap_Table_Export();
        Import::ItalyMap();
        Import::Bootstrap_Charts();
        break;

    case "it-Mappa":
        Import::it_gtag();
        Import::ItalyMap();
        break;

    case "it-Archivio":
        Import::it_gtag();
        Import::DataPicker();
        Import::Bootstrap_Table();
        Import::Bootstrap_Table_Export();
        Import::Bootstrap_Charts();
        break;

    case "it-Regione":
        Import::it_gtag();
        Import::DataPicker();
        Import::Bootstrap_Table();
        Import::Bootstrap_Table_Export();
        Import::Bootstrap_Charts();
        break;

    case "it-Live":
        Import::it_gtag();
        Import::Bootstrap_Charts();
        break;
}


?>





