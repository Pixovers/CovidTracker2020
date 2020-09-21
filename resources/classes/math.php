<?php


/*  Classe:             Math
 *  Descrizione:        Gestione e implementazione di semplici calcoli matematici
 *
 */
class Math {
    
    //Variazione percentuale di $new_val rispetto a $old_val. Le cifre decimali possono essere impostate tramite $dec_digits
    public static function percentageVariation( $old_val, $new_val, $dec_digits = 3 ) {
        return number_format( (1 - $old_val / $new_val ) * 100, $dec_digits);
    }
    
}

?>