<?php

class Import {
    public static function Bootstrap_Table() {
        ?>
        
        <!-- Bootstrap Table -->
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
        <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
        <?php
    }
    
    public static function Bootstrap_Table_Export() {
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
    
    public static function Map() {
        ?>
        
        <!-- Map -->
        <script type="text/javascript" src="/js/jqvmap/jquery.vmap.min.js"></script>
        <link href="/stylesheet/jqvmap/jqvmap.min.css" media="screen" rel="stylesheet" type="text/css"/>
        <?php if( isset( $GLOBALS['chosen_continent'] ) ) { ?>
        <script type="text/javascript" src="/js/jqvmap/maps/jquery.vmap.<?php echo strtolower(str_replace(" ", "-", $GLOBALS['chosen_continent'])); ?>.js" charset="utf-8"></script>        
        <?php
        } else {
            ?>
            <script type="text/javascript" src="/js/jqvmap/maps/jquery.vmap.world.js" charset="utf-8"></script>
            <?php
        }
    }
    
    public static function Bootstrap_Charts() {
        ?>
        
        <!-- Bootstrap Charts -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <?php
    }
    
    public static function DataPicker() {
        ?>
        
        <!-- Data Picker -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" as="style">
        
        <?php
        //<script src="/js/datapicker.js"></script>
    }
}


?>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/f458f3684b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/stylesheet/zoom.css">
        <link rel="stylesheet" href="/stylesheet/scrollbar.css">
        <link rel="stylesheet" href="/stylesheet/cookie.css">
<?php
   
    switch($CURRENT_PAGE) {
        case "Repository":
            Import::Bootstrap_Table();
            Import::DataPicker();
            Import::Bootstrap_Table_Export();
            break;
            
        case "Dashboard":
            Import::Bootstrap_Table();
            Import::Bootstrap_Charts();
            break;
            
        case "Countries":
            Import::Bootstrap_Table();
            Import::Bootstrap_Charts();
            Import::Map();
            break;
        
        case "Continents":
            Import::Bootstrap_Table();
            Import::Bootstrap_Charts();
            Import::Map();
            break;
        
        case "Map":
            Import::Map();
            break;
            
    }


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
        
        
        
        
        
        