<?php

/*
 * ©2013 Croce Rossa Italiana
 */

class Locale extends GeoPolitica {
        
    protected static
        $_t  = 'locali',
        $_dt = 'datiLocali';

    public static 
        $_ESTENSIONE = EST_LOCALE;

    
    public function nomeCompleto() {
        return $this->nome;
    }
    
    public function estensione() {
        return $this->comitati();
    }

    public function figli() {
        return $this->comitati();
    }

    public function superiore() {
        return $this->provinciale();
    }

    public function comitati() {
        return Comitato::filtra([
            ['locale',  $this->id]
        ]);
    }    

    public function aree($obiettivo = null, $espandiLocali = false ) {
        if (!$espandiLocali) {
            return parent::aree($obiettivo);
        }
        $r = parent::aree($obiettivo);
        foreach ( $this->estensione() as $c ) {
            $r = array_merge($r, $c->aree($obiettivo));
        }
        return array_unique($r);
    }
    
    public function provinciale() {
        return Provinciale::id($this->provinciale);
    }
    
    public function regionale() {
        return $this->provinciale()->regionale();
    }
    
    public function nazionale() {
        return $this->provinciale()->regionale()->nazionale();
    }
    
    public function toJSON() {
        $comitati = $this->comitati();
        $principale = $this->principale();
        foreach ( $comitati as &$comitato ) {
            $comitato = $comitato->toJSON();
        }
        
        return [
            'nome'      =>  $this->nome,
            'indirizzo' =>  $this->formattato,
            'coordinate'=>  $this->coordinate(),
            'telefono'  =>  $principale->telefono,
            'email'     =>  $principale->email,
            'principale'=>  $principale->id,
            'unita'     =>  $comitati,
            'id'        =>  $this->id
        ];
    }

    /**
     * Ottiene l'unita' territoriale principale del comitato,
     * oppure null se questa non e' presente
     */
    public function principale() {
        $p = Comitato::filtra([
            ['locale',      $this->id],
            ['principale',  1]
        ]);
        if (!$p) { return false; }
        return $p[0];
    }

    public static function localiNull() {
        global $db;
        $q = $db->prepare("
            SELECT 
                id 
            FROM
                locali
            WHERE 
                nome IS NULL
            ");
        $r = $q->execute();
        $r = [];
        while ( $k = $q->fetch(PDO::FETCH_NUM) ) {
            $r[] = $k[0];
        }
        return $r;
    }
    
}