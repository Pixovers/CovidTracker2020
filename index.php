<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">

  <!-- sistemare -->
  <link rel="icon" href="   ">
  <title>COVID NEWS</title>
  <meta name="description" content="aggiornamenti, hai la possivilita' di scaricare tutti i dati messi a disposizione">
  <meta name="keywords" content="covid, coronavirus, emergenza, ecc">
  <!-- sistemare -->

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- import css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">

  <!-- import css -->

</head>

<body>

  <div class="loader_bg">
    <div class="loader">
   
    </div> 
   </div>


<!-- custom scrollbar-->
<style>body {
  height: 200vh;
}
body::-webkit-scrollbar {
  width: 0.6rem;
}
body::-webkit-scrollbar-track {
 /* background: rgb(233, 233, 233); */
}
body::-webkit-scrollbar-thumb {
  background: rgb(18, 148, 235) ;
  border-radius: 10px;
}</style>
<!-- custom scrollbar-->


  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <img
      src="https://images.vexels.com/media/users/3/193114/isolated/preview/0be3590284a8dc5f1646b64816e2eb6e-covid-stop-badge-by-vexels.png"
      width="30" height="30" alt="Covid" loading="lazy">
    <a class="navbar-brand" href="#">COVID TRACKER 2020</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        <li class="nav-item">
          <a class="nav-link" href="#">Map</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Contacts
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">email</a>
            <a class="dropdown-item" href="#">about us</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else</a>
          </div>
        </li>

      </ul>
      <button type="button" class="btn btn-danger">Donazioni</button>
      </form>
    </div>
  </nav>
  <!-- nabar -->




<!--splash screen-->
<style>
  .loader_bg{
    position: fixed;
    z-index: 999999;
    background: #fff;
    width: 100%;
    height: 100%;
  }

  .loader{
    border: 0 solid transparent;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    position: absolute;
    top:calc(50vh - 75px);
    left:calc(50vw - 75px);

  }

.loader:before,.loader:after{
  content: '';
  border:  1em solid #ff5733;
  border-radius: 50%;
  width: inherit;
  height: inherit;
  position: absolute;
  top: 0;
  left: 0;
  animation: loader 2s linear infinite;
  opacity: 0;
}

.loader:before{

animation-delay: .5s ;
}

@keyframes loader{
   0%{
        transform: scale(0);
        opacity: 0;        
}

50%{
  opacity: 1;
}
100%{
   transform: scale(1);
   opacity: 0;

}

}

</style>
<!--splash screen-->

<!--prima riga-->
  <div class="pt-5">
    <div class="container-fluid">
      <div class="row">
        <!--Info generali-->
        <div class="col-md-4" style="">
          <div class="card shadow-lg">
            <div class="card-body">
              <h5 class="card-title"><b>Info generali</b></h5>
              <h6 class="card-subtitle my-2 text-muted">sadasd</h6>
              <p class="card-text">asdasdasdas</p>
              <a href="#" class="card-link">link utili</a>
              <a href="#" class="card-link">link utili</a>
            </div>
          </div>
          <!--Info generali-->

        </div>

        <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $db = "covid_db";
          
                  $conn = new mysqli($servername, $username, $password, $db );
          
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
              ?>


        <!--prima dabella (Mondo)-->
        <div class="col-md-8" style="">
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>MONDO</b></div>
            <div class="card-body bg-light text-primary">

              <table id="mondo" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16'";
                    
                    //esecuzione della query
                    $result = $conn->query($sql);
                    

                    if ($result->num_rows > 0) {

                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
            
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
            
                      }
                    }

                  ?>
                </tbody>
              </table>




              <!-- script per esportare i file delle tabelle -->
              <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
              <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
              <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
              <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
              <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
              <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
              <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
              <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
              <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
              <!-- script per esportare i file delle tabelle -->


            </div>
          </div>
        </div>
        <!--prima dabella (Mondo)-->
      </div>
    </div>
  </div>
  </div>
<!--prima riga-->

<!--seconda riga-->
  <div class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>NORD AMERICA</b></div>
            <div class="card-body bg-light text-primary">

              <!--seconda Tabella (nord  America)-->
              <table id="nordAmerica" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16' AND continent = 'North America'";
                                  
                    //esecuzione della query
                    $result = $conn->query($sql);
                                  
              
                    if ($result->num_rows > 0) {
              
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                          
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                          
                      }
                    }
              
                  ?>
                </tbody>
              </table>
               <!--seconda Tabella (nord America)-->
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>SUD AMERICA</b></div>
            <div class="card-body bg-light text-primary">

              <!--terza dabella (sud America)-->
              <table id="sudAmerica" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16' and continent = 'South America'";
                                  
                    //esecuzione della query
                    $result = $conn->query($sql);
                                  
              
                    if ($result->num_rows > 0) {
              
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                          
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                          
                      }
                    }
              
                  ?>                  
                </tbody>
              </table>
              <!--terza dabella (sud America)-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--seconda riga-->

<!--terza riga-->
  <div class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>EUROPA</b></div>
            <div class="card-body bg-light text-primary">
            <!--Quarta tabella (Europa)-->
              <table id="Europa" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16' AND continent='Europe'";
                                  
                     //esecuzione della query
                    $result = $conn->query($sql);
                                  
              
                    if ($result->num_rows > 0) {
              
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                          
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                          
                      }
                    }
              
                  ?>                  
                </tbody>
              </table>
             <!--Quarta tabella (Europa)-->

            </div>
          </div>
        </div>
        <div class="col-md-6">
       
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>ASIA</b></div>
            <div class="card-body bg-light text-primary">

              <!--Quinta tabella (Asia)-->
              <table id="Asia" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16' AND continent = 'Asia'";
                                  
                    //esecuzione della query
                    $result = $conn->query($sql);
                                  
              
                    if ($result->num_rows > 0) {
              
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                          
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                          
                      }
                    }
              
                  ?>                  
                </tbody>
              </table>
              <!--Quinta tabella (Asia)-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--terza riga-->

<!--quarta riga-->
  <div class="py-3 pb-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>AFRICA</b></div>
            <div class="card-body bg-light text-primary">

              <!--sesta tabella (Africa)-->
              <table id="Africa" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                  
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                           "FROM covid_data ".
                           "WHERE date = '2020-07-16' AND continent = 'Africa'";
                                  
                    //esecuzione della query
                    $result = $conn->query($sql);
                                  
              
                    if ($result->num_rows > 0) {
              
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                          
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                          
                      }
                    }
              
                  ?>                  
                </tbody>
              </table>
               <!--seconda tabella (Africa)-->
            </div>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="card text-white bg-secondary shadow-lg">
            <div class="card-header"><b>OCEANIA</b></div>
            <div class="card-body bg-light text-primary">

              <!--settima tabella (Oceania)-->
              <table id="Oceania" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">CONFIRMED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">DECEASED</th>
                    <th scope="col">CHANGES TODAY</th>
                    <th scope="col">TESTS</th>
                    <th scope="col">CHANGES TODAY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                    
                    //creazione del testo della query
                    $sql = "SELECT location, total_cases, new_cases, total_deaths, new_deaths, total_tests, new_tests ".
                            "FROM covid_data ".
                            "WHERE date = '2020-07-16' AND continent = 'Oceania'";
                                    
                    //esecuzione della query
                    $result = $conn->query($sql);
                                    
                
                    if ($result->num_rows > 0) {
                
                      //per ogni record del risultato della query eseguita
                      while($row = $result->fetch_assoc()) {
                            
                        //crea una riga in tabella
                        echo "<tr>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["total_cases"] . "</td>";
                        echo "<td>↑ " . $row["new_cases"] . "</td>";
                        echo "<td>" . $row["total_deaths"] . "</td>";
                        echo "<td>↑ " . $row["new_deaths"] . "</td>";
                        echo "<td>" . $row["total_tests"] . "</td>";
                        echo "<td>↑ " . $row["new_tests"] . "</td>";
                        echo "</tr>";		
                            
                      }
                    }
                
                  ?>                  
                </tbody>
              </table>
               <!--settima tabella (Oceania)-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--quarta riga-->

<!--footer-->
<div class="">
    <div class="container-fluid py-5 shadow-lg border-danger bg-primary">
      <div class="row bg-primary">
        <div class="p-4 col-md-3 shadow-lg border-secondary bg-info" style="">
          <h2 class="mb-4">COVID</h2>
          <p>nulla</p>
        </div>
        <div class="p-4 col-md-3 border-success bg-success shadow-lg">
          <h2 class="mb-4">Mapsite</h2>
          <ul class="list-unstyled"> <a href="#" class="text-dark">Home</a> <br> <a href="#" class="text-dark">map</a>
            <br> <a href="#" class="text-dark">contacts</a> <br> <a href="#" class="text-dark">about us</a> </ul>
        </div>
        <div class="p-4 col-md-3 bg-danger shadow-lg">
          <h2 class="mb-4">Contact</h2>
          <p contenteditable="true"> <a href="#" class="text-dark">
              <i class="fa d-inline mr-3 text-muted fa-envelope-o"></i>e</a>mail</p>
        </div>
        <div class="p-4 col-md-3 text-body bg-warning shadow-lg">
          <h2 class="mb-4">Subscribe</h2>
          <form>
            <fieldset class="form-group"> <label for="exampleInputEmail1">Get our newsletter</label> <input type="email"
                class="form-control" placeholder="Enter email"> </fieldset> <button type="submit"
              class="btn btn-outline-dark">Submit</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center">© Copyright&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
<!--footer riga-->

<!--script tabelle-->
<div>

  <script>
    
    $(document).ready(function () {
      var table = $('#mondo').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'csv', 'pdf']
      });

      table.buttons().container()
        .appendTo('#mondo_wrapper .col-md-6:eq(0)');
    });
  </script>

  <script>
    $(document).ready(function () {
      var table = $('#nordAmerica').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'csv', 'pdf']
      });

      table.buttons().container()
        .appendTo('#nordAmerica_wrapper .col-md-6:eq(0)');
    });
  </script>

<script>
  $(document).ready(function () {
    var table = $('#sudAmerica').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'csv', 'pdf']
    });

    table.buttons().container()
      .appendTo('#sudAmerica_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(document).ready(function () {
    var table = $('#Europa').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'csv', 'pdf']
    });

    table.buttons().container()
      .appendTo('#Europa_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(document).ready(function () {
    var table = $('#Asia').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'csv', 'pdf']
    });

    table.buttons().container()
      .appendTo('#Asia_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(document).ready(function () {
    var table = $('#Africa').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'csv', 'pdf']
    });

    table.buttons().container()
      .appendTo('#Africa_wrapper .col-md-6:eq(0)');
  });
</script>


<script>
  $(document).ready(function () {
    var table = $('#Oceania').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'csv', 'pdf']
    });

    table.buttons().container()
      .appendTo('#Oceania_wrapper .col-md-6:eq(0)');
  });
</script>
</div>
<!--script tabelle-->


     <!--Import-->         
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

     <!--Import-->         


    <!--script splash screen-->
<script>
  setTimeout(function(){
    $('.loader_bg').fadeToggle();
  }, 1500);
</script>
</body>
<!--script splash screen-->

</html>