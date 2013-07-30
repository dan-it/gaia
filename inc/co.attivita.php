<?php

/*
 * ©2013 Croce Rossa Italiana
 */
paginaApp([APP_CO , APP_PRESIDENTE]);

?>
<?php if ( isset($_GET['monta']) ) { ?>
        <div class="alert alert-success">
            <i class="icon-ok"></i><strong> Volontario in turno</strong>
        </div>
<?php } elseif ( isset($_GET['smonta']) )  { ?>
        <div class="alert alert-block alert-error">
            <i class="icon-exclamation-sign"></i><strong> Volontario smontato</strong>
        </div>
<?php } ?>
    <br/>
<div class="row-fluid">
    <div class="span5 allinea-sinistra">
        <h2>
            <i class="icon-time muted"></i>
            Elenco attività odierne
        </h2>
    </div>
    
    <div class="span3">
        <div class="btn-group btn-group-vertical span12">
                <a href="?p=co.dash" class="btn btn-block ">
                    <i class="icon-reply"></i> Torna alla dash
                </a>
        </div>
    </div>
    
    <div class="span4 allinea-destra">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input autofocus required id="cercaUtente" placeholder="Cerca Volontari e Attività..." type="text">
        </div>
    </div>    
</div>
<hr />
<div class="row-fluid">
   <div class="span12">
       <table class="table table-striped table-bordered table-condensed" id="tabellaUtenti">
            <thead>
                <th>Turno</th>
                <th>Inizio</th>
                <th>Fine</th>
            </thead>
        <?php
        $i = time();
        $f = time()+86400;
        $comitati = $me->comitatiApp ([ APP_CO, APP_PRESIDENTE ]);
        $elenco = Attivita::elenco();
        foreach($comitati as $comitato){
            foreach($elenco as $attivita) {
                if($attivita->comitato == $comitato){
                    $x=0;
                    $turni = $attivita->turni();
                    foreach($turni as $turno){
                        $partecipanti = $turno->partecipazioniStato(AUT_OK);
                        foreach ($partecipanti as $partecipante){ 
                            $m= Coturno::filtra([['volontario', $partecipante->volontario()],['turno',$turno]]); 
                            if (($turno->inizio>= $i  && $turno->fine <= $f) || ($m[0]->pMonta && !$m[0]->pSmonta)) {
                                if($x==0){ ?> 
                                    <tr class="primary">
                                        <td colspan="4" class="grassetto">
                                        <?php echo $attivita->nome; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    $x++;
                                    } ?>
                                <tr class="info">
                                       <td><?php echo $turno->nome; ?></td>
                                       <td><?php echo date('d-m-Y H:i', $turno->inizio); ?></td>
                                       <td><?php echo date('d-m-Y H:i', $turno->fine); ?></td>
                                </tr>
                                <tr class="<?php if(!$m[0]->pSmonta && !$m[0]->stato == CO_MONTA){echo "warning"; }elseif($m[0]->stato == CO_MONTA){ echo "success";}else{echo "error";}?>">
                                   <td><?php echo $partecipante->volontario()->nomeCompleto(); ?></td>
                                   <td><?php echo $partecipante->volontario()->cellulare(); ?></td>
                                   <td>
                                       <div class="btn-group">
                                           <?php if($m[0]->stato == '' || !$m[0]->stato == CO_MONTA || $m[0]->stato == CO_MONTA){ ?>
                                            <a class="btn btn-small btn" target="_new" href="?p=public.utente&id=<?php echo $partecipante->volontario(); ?>" title="Monta">
                                                <i class="icon-eye-open"></i> Visualizza
                                            </a>
                                           <?php } ?>
                                           <?php if(!$m[0]->stato == CO_MONTA){ ?>
                                                <a class="btn btn-small btn-success" href="?p=co.attivita.ok&v=<?php echo $partecipante->volontario(); ?>&t=<?php echo $turno; ?>&monta" title="Monta">
                                                    <i class="icon-arrow-up"></i> Monta
                                                </a>
                                            <?php } 
                                            if($m[0]->stato == CO_MONTA){ ?>
                                                <a class="btn btn-small btn-danger" href="?p=co.attivita.ok&v=<?php echo $partecipante->volontario(); ?>&t=<?php echo $turno; ?>&smonta" title="Smonta">
                                                    <i class="icon-arrow-down"></i> Smonta
                                                </a>
                                           <?php } ?>
                                       </div>
                                   </td>
                                </tr>
        <?php }}}}}}?>
        </table>
    </div>
</div>
