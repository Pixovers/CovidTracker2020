
//restituisce true se la dark mode è attiva
//restituisce false se la dark mode è disattiva
function isDarkMode() {
    if( getCookie("theme") == "dark" ) {
        return true;
    } else if( getCookie("theme") == "light" ) {
        return false;
    }
}



//inverte la modalità attuale
function toggleDarkMode() {
    if( getCookie("theme") == "" ) {
        document.cookie = "theme=light";
    }


    if( getCookie("theme") == "dark" ) {
        setDarkMode(false);
        document.cookie = "theme=light";
    } else if( getCookie("theme") == "light" ) {
        setDarkMode(true);
        document.cookie = "theme=dark";
    }
}

//imposta la dark mode in base a value (valore booleano)
function setDarkMode( value ) {

    //background
    if( value ) {
        document.body.style.backgroundColor = "#445174";

    } else {
        document.body.style.backgroundColor = "#ffffff";
    }

    //variabile contatore
    var i;

    //setup tabelle
    var tables = document.getElementsByTagName("TABLE");
    for( i = 0; i < tables.length; i++ ) {
        if( value ) {
            tables[i].classList.add("table-dark");
        } else {
            tables[i].classList.remove("table-dark");
        }
    }

    //setup di tutti gli oggetti appartenenti alla classe dark_mode_object
    var tbodies = document.getElementsByClassName("dark_mode_object");
    for( i = 0; i < tbodies.length; i++ ) {
        if( value ) {
            tbodies[i].classList.add("bg-dark");
        } else {
            tbodies[i].classList.remove("bg-dark");
        }
    }
}