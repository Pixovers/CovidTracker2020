<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary dark_mode_object" id="nav">

    <!--Logo-->
    <a title="Official Covid Tracker 2020" alt="Mask-for-Covid" href="https://www.covidtracker2020.live/">
        <img id="mask_logo" src="#" alt="Sun-blue" width="32" height="32" />
    </a>

    <a class="navbar-brand ml-1" title="Official Covid Tracker 2020" href="https://www.covidtracker2020.live/">COVID TRACKER 2020</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item  <?php if ("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"  == "https://www.covidtracker2020.live/" || "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/") {
                                        echo "active";
                                    }  ?>">
                <a class="nav-link" title="Home" href="https://www.covidtracker2020.live/">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item  <?php if ("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"  == "https://www.covidtracker2020.live/pages/repository/" || "https://www.covidtracker2020.live/pages/repository/") {
                                        echo "activ ";
                                    }  ?>">
                <a class="nav-link" title="Repository" href="https://www.covidtracker2020.live/pages/repository/">Repository <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item <?php if (" https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/map/ " || "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/map/ ") {
                                    echo "active";
                                }  ?>  ">
                <a class="nav-link" title="Map" href="https://www.covidtracker2020.live/pages/map/">Map<span class="sr-only">(current)</span></a>

            <li class="nav-item <?php if (" https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/blog/ " || "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/blog/") {
                                    echo "active";
                                }  ?>  ">
                <a class="nav-link" title="Blog" href="https://www.covidtracker2020.live/pages/blog">Blog<span class="sr-only">(current)</span></a>
            </li>

         <!--   <li class="nav-item <?php// if (" https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/live_counter/ " || "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/live_counter/") {
                                   // echo "active ";
                            //    }  ?>  ">
                <a class="nav-link" title="Live" href="https://www.covidtracker2020.live/pages/live_counter/">Live <span class="sr-only">(current)</span></a>
            </li-->


            <li class="nav-item <?php if (" https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/About/ " || "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] "  == "https://www.covidtracker2020.live/pages/About/") {
                                    echo "active ";
                                }  ?>  ">
                <a class="nav-link" title="About Us" href="https://www.covidtracker2020.live/pages/About/">About Us <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" title="About Us" href="https://www.covidtracker2020.live/pages/countries/">Countries <span class="sr-only">(current)</span></a>
            </li>


        </ul>

        <a id="Sun-blue" title="Sun" alt="blue-sun-Covid" href="https://www.covidtracker2020.live/">
            <img id="sun_img" class="mr-1" src="#" alt="Sun-blue" width="32" height="32" />
        </a>

        <input class="dm_switch" data-on="Light Mode" data-off="Dark Mode" onchange="toggleDarkMode()" type="checkbox" id="dark_mode_switch" name="theme">
        <label class="dm_switch mr-4 mt-2 " for="dark_mode_switch" onchange="toggleDarkMode()" class="mr-4 mt-2 ml-1">Toggle</label>


        <style>
            input[type=checkbox].dm_switch {
                height: 0;
                width: 0;
                visibility: hidden;
            }

            label.dm_switch {
                cursor: pointer;
                text-indent: -9999px;
                width: 52px;
                height: 27px;
                background: grey;
                float: right;
                border-radius: 100px;
                position: relative;
            }

            label.dm_switch:after {
                content: '';
                position: absolute;
                top: 3px;
                left: 3px;
                width: 20px;
                height: 20px;
                background: #fff;
                border-radius: 90px;
                transition: 0.3s;
            }

            input.dm_switch:checked+label.dm_switch {
                background: var(--color-headings);
            }

            input.dm_switch:checked+label.dm_switch:after {
                left: calc(100% - 5px);
                transform: translateX(-100%);
            }

            label.dm_switch:active:after {
                width: 45px;
            }

            html.transition,
            html.transition *,
            html.transition *:before,
            html.transition *:after {
                transition: all 750ms !important;
                transition-delay: 0 !important;
            }
        </style>


        <!-- <button type="button" class="btn btn-warning btn-sm mr-5" onclick="setDarkMode(true)">Try Dark Mode</button> -->

        <script type='text/javascript' src='https://ko-fi.com/widgets/widget_2.js'></script>
        <script type='text/javascript'>
            kofiwidget2.init('Support Me on Ko-fi', '#20e648', 'S6S41Y4BV');
            kofiwidget2.draw();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    </div>
</nav>

<!-- navbar -->