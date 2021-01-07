
<?php
include "/home/covid/resources/config.php";


    include '../flags_managment.php';
    include '../counters_managment.php';


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

<style>
      html, body {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
      }
      #vmap {
        width: 100%;
        height: 100%;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
      }
      .jqvmap-zoomin {
        width: 30px;
        height: 30px;
        line-height: 30px;
      }
      .jqvmap-zoomout {
        width: 30px;
        height: 30px;
        top: 55px;
        line-height: 30px;
      }
    </style>

    <script>
      jQuery(document).ready(function () {
        jQuery('#vmap').vectorMap({
          map: 'world_en',
          backgroundColor: 'rgba(0,0,0,0)',
          color: '#353a40',
          hoverOpacity: 0.7,
          selectedColor: '#666666',
          enableZoom: true,
          showTooltip: true,
          scaleColors: ['#FFFFFF','#66ccff','#000099'],
          values: sample,
          normalizeFunction: 'polynomial',
            onLabelShow: function(event, label, code)
            {
            

              function checkCode( code_value ) {
                return code == code_value[0];
              }
              //console.log( data.find(checkCode));

              //vettore fina
              country = data.find(checkCode);
              if( typeof country !== 'undefined' ) {
                    // HTML Based Labels. You can use any HTML you want, this is just an example
                    label.html('<div class="col py-2">' +
        ' <img  class="h4 d-block mx-auto rounded" height="40px" src="https://www.covidtracker2020.live/images/flags/' +code+ '.png" alt=""> </img>'+
        '<div class="title text-center h5"> '+country[1]+' </div>'+
        '<table>'+
        '<tbody>'+
        '<tr>'+
    
        '<td>  <span class="deaths text-warning">'    +'Total cases: ' +country[2]+ ' </span></td>'+
        '</tr>'+
        '<tr>'+
        
        '<td><span class="critical  text-danger">' +'New cases: '+country[3]+'</span></td>'+
        '</tr>'+
        '<tr>'+
       
        '<td><span class="active primary text-success">'   + 'Total Deaths: ' +country[4]+ '</span></td>'+
        '</tr>'+
        '<tr>'+
        
        '<td><span class="recovered danger text-primary">'  +  'New Deaths: ' + country[5]+ '</span></td>'+
        '</tr>'+
        '</tbody>'+
        '</table>'+
        '</div>'
      );
              }
              
            },
        });





        //Do something when the map is dragged
jQuery('#vmap').on('drag', function(event)
{
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
        <div class="container-fluid">
        <div id="vmap" style="height:calc(100vh - 40px);">
        
        </div>


        
        </div>
      <div class="text-center">
      
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-h2+d+5c-9-3e"
     data-ad-client="ca-pub-1084371123442891"
     data-ad-slot="8131849345"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>  
      
      </div>
      
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <?php
            
        ?>




<?php
    include '/home/covid/resources/templates/footer.php';
    include '/home/covid/resources/templates/cookie-popup.php';
    ?>
    </body>
</html>
