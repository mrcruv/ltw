CREATE OR REPLACE TABLE utenti (
    username varchar(30) PRIMARY KEY,
    password varchar(60) NOT NULL,
    piva char(11) UNIQUE NOT NULL,
    cf varchar(16) UNIQUE NOT NULL,
    sito_web varchar(255),
    pec varchar(255) UNIQUE NOT NULL
);

CREATE OR REPLACE TABLE enti (
    username varchar(30) PRIMARY KEY,
    denominazione varchar(50) UNIQUE NOT NULL,
    tipo ENUM("pubblico", "privato") NOT NULL,
    FOREIGN KEY(username) REFERENCES utenti(username)
);

CREATE OR REPLACE TABLE esperti (
    username varchar(30) PRIMARY KEY,
    nome varchar(255) NOT NULL,
    cognome varchar(255) NOT NULL,
    citta_nascita varchar(255) NOT NULL,
    data_nascita DATE NOT NULL,
    FOREIGN KEY(username) REFERENCES utenti(username)
);

CREATE OR REPLACE TABLE processi (
    nome varchar(255),
    ente varchar(30),
    data_conclusione DATE,
    tipologia varchar(255) NOT NULL,
    descrizione TEXT NOT NULL,
    PRIMARY KEY(nome, ente),
    FOREIGN KEY(ente) REFERENCES enti(username)
);

CREATE OR REPLACE TABLE disponibilita (
    processo varchar(255),
    ente varchar(30),
    esperto varchar(30),
    data_richiesta DATE NOT NULL,
    data_assegnazione DATE,
    data_rifiuto DATE,
    PRIMARY KEY(processo, ente, esperto),
    FOREIGN KEY(processo, ente) REFERENCES processi(nome, ente),
    FOREIGN KEY(esperto) REFERENCES esperti(username)
);

CREATE OR REPLACE TABLE titoli (
    denominazione varchar(255) PRIMARY KEY
);

CREATE OR REPLACE TABLE diplomi (
    titolo varchar(255) PRIMARY KEY,
    tipo varchar(255) NOT NULL,
    FOREIGN KEY(titolo) REFERENCES titoli(denominazione)
);

CREATE OR REPLACE TABLE lauree (
    titolo varchar(255) PRIMARY KEY,
    tipo ENUM("triennale", "magistrale", "a ciclo unico") NOT NULL,
    classe varchar(7) NOT NULL,
    FOREIGN KEY(titolo) REFERENCES titoli(denominazione)
);

CREATE OR REPLACE TABLE competenze (
    nome varchar(255) PRIMARY KEY,
    settore varchar(255) NOT NULL
);

CREATE OR REPLACE TABLE competenze_esperti (
    esperto varchar(30),
    competenza varchar(255),
    descrizione TEXT,
    FOREIGN KEY(esperto) REFERENCES esperti(username),
    FOREIGN KEY(competenza) REFERENCES competenze(nome),
    PRIMARY KEY(esperto, competenza)
);

CREATE OR REPLACE TABLE titoli_esperti (
    esperto varchar(30),
    titolo varchar(255),
    data_conseguimento DATE,
    note TEXT,
    voto SMALLINT,
    PRIMARY KEY(esperto, titolo),
    FOREIGN KEY(esperto) REFERENCES esperti(username),
    FOREIGN KEY(titolo) REFERENCES titoli(denominazione)
);