//funzione chiamata all'inizio di ogni pagina, per inizializzare la dark/light mode
function initializeDarkMode() {
    //alert(window.name);
    var dm_switch = document.getElementById("dark_mode_switch");

    if (window.name == "dark") {
        dm_switch.checked = true;
    } else if (window.name == "light") {
        dm_switch.checked = false;
    }
    if (dm_switch.checked == true) {
        setDarkMode(true);
    } else {
        setDarkMode(false);
    }

}


//inverte la modalità attuale
function toggleDarkMode() {
    if (window.name == "") {
        window.name = "light";
    }

    if (window.name == "dark") {
        setDarkMode(false);

    } else if (window.name == "light") {
        setDarkMode(true);
    }
}

//imposta la dark mode in base a value (valore booleano)
function setDarkMode(value) {


    //setup valore cookie
    if (value) {
        window.name = "dark";
    } else {
        window.name = "light";
    }




    //background
    if (value) {
        //document.body.style.backgroundColor = "#445174";
        document.body.style.backgroundColor = "#484d53";

    } else {
        document.body.style.backgroundColor = "#ffffff";
    }

    //variabile contatore
    var i;

    //setup tabelle
    var tables = document.getElementsByTagName("TABLE");
    for (i = 0; i < tables.length; i++) {
        if (value) {
            tables[i].classList.add("table-dark");
        } else {
            tables[i].classList.remove("table-dark");
        }
    }

    //setup di tutti gli oggetti appartenenti alla classe dark_mode_object
    var tbodies = document.getElementsByClassName("dark_mode_object");
    for (i = 0; i < tbodies.length; i++) {
        if (value) {
            tbodies[i].classList.add("bg-dark");
        } else {
            tbodies[i].classList.remove("bg-dark");
        }
    }

    //setup di tutti i testi
    var texts = document.getElementsByClassName("dark_mode_div");
    for (i = 0; i < texts.length; i++) {
        if (value) {
            texts[i].style.color = "white";
        } else {
            texts[i].style.color = "black";
        }
    }



    //setup logo mascherina
    var mask_img;
    if (value) {
        document.getElementById("mask_logo").src = "/images/mask_dark.png";
    } else {
        document.getElementById("mask_logo").src = "/images/mask_light.png";
    }

    //setup logo 
    var sun_img;
    if (value) {
        document.getElementById("sun_img").src = "/images/sun_dark.png";
    } else {
        document.getElementById("sun_img").src = "/images/sun_light.png";
    }



}