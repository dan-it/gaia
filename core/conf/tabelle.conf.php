<?php

/*
 * ©2012 Croce Rossa Italiana
 */

$conf['database']['tables'] = [
        [
            'name'      =>  'sessioni',
            'fields'    =>  '
                id       varchar(128) PRIMARY KEY,
                utente   int,
                azione   varchar(64),
                ip       varchar(64),
                agent    varchar(255)
            '
        ],
        [
            'name'      =>  'datiSessione',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'anagrafica',
            'fields'    =>  '
                id              int PRIMARY KEY,
                nome            varchar(255),
                cognome         varchar(255),
                stato           varchar(8),
                email           varchar(255),
                password        varchar(127),
                codiceFiscale   varchar(16),
                timestamp       varchar(64),
                admin           varchar(64),
                INDEX (codiceFiscale),
                INDEX(email)
            '
        ],
        [
            'name'      =>  'dettagliPersona',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'comitati',
            'fields'    =>  '
                id       int PRIMARY KEY,
                nome     varchar(64),
                colore   varchar(8)
            '
        ],
        [
            'name'      =>  'avatar',
            'fields'    =>  '
                id          int PRIMARY KEY,
                utente      varchar(64),
                timestamp   varchar(8),
                INDEX(utente)
            '
        ],
        [
            'name'      =>  'appartenenza',
            'fields'    =>  '
                id          int PRIMARY KEY,
                volontario  varchar(16),
                comitato    varchar(16),
                stato       varchar(8),
                inizio      varchar(64),
                fine        varchar(64),
                timestamp   varchar(64),
                conferma    varchar(64),
                INDEX (volontario),
                INDEX (comitato)
            '
        ],
        [
            'name'      =>  'titoli',
            'fields'    =>  '
                id          int PRIMARY KEY,
                nome        varchar(255),
                tipo        varchar(8),
                FULLTEXT ( nome )
            '
        ],
        [
            'name'      =>  'titoliPersonali',
            'fields'    =>  '
                id              int PRIMARY KEY,
                volontario      varchar(16),
                titolo          varchar(16),
                inizio          varchar(64),
                fine            varchar(64),
                luogo   varchar(64),
                codice varchar(64),
                tConferma       varchar(64),
                pConferma       varchar(64),
                INDEX (volontario)
            '
        ],
        [
            'name'      =>  'attivita',
            'fields'    =>  '
                id              int,
                nome            varchar(255),
                luogo           varchar(255),
                comitato        varchar(32),
                pubblica        varchar(8),
                tipo            varchar(8),
                referente       varchar(32),
                geo             point NOT NULL,
                descrizione     text,
                PRIMARY KEY (id),
                INDEX (comitato),
                INDEX (referente),
                INDEX (tipo),
                SPATIAL INDEX(geo)
            '
        ],
        [
            'name'      =>  'dettagliAttivita',
            'fields'    =>  '
                id       varchar(128),
                nome     varchar(32),
                valore   text,
                PRIMARY KEY (id, nome)
            '
        ],
        [
            'name'      =>  'documenti',
            'fields'    =>  '
                id          varchar(64) PRIMARY KEY,
                volontario  varchar(16),
                tipo        varchar(8),
                timestamp   varchar(64),
                INDEX (volontario)
            '
        ],
        [
            'name'      =>  'autorizzazioni',
            'fields'    =>  '
                id              int PRIMARY KEY,
                volontario      varchar(16),
                partecipazione  varchar(16),
                timestamp       varchar(64),
                pFirma          varchar(16),
                tFirma          varchar(64),
                note            text,
                INDEX ( volontario ),
                INDEX ( partecipazione )
            '
        ],
        [
            'name'      =>  'turni',
            'fields'    =>  '
                id          int PRIMARY KEY,
                attivita    varchar(16),
                nome        varchar(64),
                inizio      varchar(64),
                fine        varchar(64),
                timestamp   varchar(64)
            '
        ],
        [
            'name'      =>  'partecipazioni',
            'fields'    =>  '
                id          int PRIMARY KEY,
                volontario  varchar(16),
                turno       varchar(16),
                stato       varchar(8),
                tipo        varchar(8),
                timestamp   varchar(64),
                tConferma   varchar(64),
                pConferma   varchar(16),
                INDEX ( volontario ),
                INDEX ( turno )
            '
        ],
        [
            'name'  =>  'delegati',
            'fields'    =>  '
                id              int PRIMARY KEY,
                comitato        varchar(16),
                volontario      varchar(16),
                applicazione    varchar(16),
                dominio         varchar(16),
                inizio      varchar(64),
                fine        varchar(64),
                pConferma       varchar(16),
                tConferma       varchar(64)'
        ]
        
];