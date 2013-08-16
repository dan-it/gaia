<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaApp([APP_SOCI, APP_PRESIDENTE]);

$t = $_POST['inputVolontario'];
$c = $_POST['inputComitato'];
$m = $_POST['inputMotivo'];
echo $t, '<br/>';
echo $c, '<br/>';
echo $m, '<br/>';
/* Cerco appartenenze al comitato specificato */
$f = Appartenenza::filtra([
  ['volontario',    $t],
  ['comitato',      $c]
]);

/* Se sono già appartenente *ora*,
 * restituisco errore
 */

foreach ( $f as $app ) {
    if ($app->attuale()) { 
        redirect('us.utente.trasferisci&e'); 
        break;
    } 
}
                                     
/*Se non sono appartenente allora avvio la procedura*/

foreach ( $t->storico() as $app ) {
    
    if ($app->attuale()) {
        
        $a = new Appartenenza();
        $a->volontario  = $t->id;
        $a->comitato    = $c;
        $a->stato =     TRASF_INCORSO;
        $a->timestamp = time();
        $a->inizio    = time();
        
        $t = new Trasferimento();
        $t->stato = TRASF_INCORSO;
        $t->appartenenza = $a;
        $t->volontario = $t->id;
        $t->motivo = $m;
        $t->timestamp = time();
        
       // redirect('us.dash&trasfok');

    }
    
}
                               
