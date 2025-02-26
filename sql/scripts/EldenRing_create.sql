CREATE DATABASE EldenRing;

USE eldenring;

-- Tabella Categorie
CREATE TABLE Categorie
(
    id_categoria VARCHAR(50) PRIMARY KEY,    -- Chiave primaria per la tabella Categorie
    nome         VARCHAR(50) NOT NULL UNIQUE -- Nome della categoria (non nullo) con unicità
);

-- Tabella TipiStatistiche
CREATE TABLE TipiStatistiche
(
    id_tipo VARCHAR(50) PRIMARY KEY,    -- Chiave primaria per la tabella TipiStatistiche
    nome    VARCHAR(50) NOT NULL UNIQUE -- Nome del tipo di statistica (non nullo) con unicità
);

-- Tabella Attributi
CREATE TABLE Attributi
(
    id_attributo VARCHAR(50) PRIMARY KEY,    -- Chiave primaria per la tabella Attributi
    nome         VARCHAR(50) NOT NULL UNIQUE -- Nome dell'attributo (non nullo) con unicità
);

-- Tabella Effetti_Stato
CREATE TABLE EffettiStato
(
    nome                  VARCHAR(50) PRIMARY KEY, -- Nome univoco dell'effetto (es: Sanguinamento, Assideramento)
    descrizione           TEXT NOT NULL,           -- Descrizione dettagliata dell'effetto
    icona                 TEXT NOT NULL,           -- Link all'immagine che rappresenta l'effetto
    mitigato_da           TEXT,                    -- Oggetti o abilità che riducono l'effetto
    curato_da             TEXT,                    -- Oggetti o abilità che rimuovono l'effetto
    statistica_resistente VARCHAR(50),             -- Statistica che aumenta la resistenza all'effetto
    note                  TEXT                     -- Note aggiuntive (es: condizioni speciali)
);

-- Tabella Armi
CREATE TABLE Armi
(
    id_arma      INTEGER PRIMARY KEY AUTO_INCREMENT,          -- Chiave primaria autoincrementata per la tabella Armi
    nome         TEXT          NOT NULL,                      -- Nome dell'arma (non nullo)
    descrizione  TEXT          NOT NULL,                      -- Descrizione dell'arma (non nullo)
    immagine     TEXT          NOT NULL,                      -- URL dell'immagine dell'arma (non nullo)
    id_categoria VARCHAR(50)   NOT NULL,                      -- Riferimento alla categoria dell'arma (non nullo)
    peso         DECIMAL(3, 1) NOT NULL,                      -- Peso dell'arma (non nullo)
    ottenimento  TEXT          NOT NULL,                      -- Come ottenere l'arma (non nullo)
    FOREIGN KEY (id_categoria)
        REFERENCES Categorie (id_categoria) ON UPDATE CASCADE -- Vincolo per la relazione con Categorie
);

-- Tabella armi_effetti
CREATE TABLE ArmiEffetti
(
    id_arma      INTEGER,
    nome_effetto VARCHAR(50),
    valore       INTEGER NOT NULL,
    PRIMARY KEY (id_arma, nome_effetto),
    FOREIGN KEY (id_arma) REFERENCES armi (id_arma) ON UPDATE CASCADE,
    FOREIGN KEY (nome_effetto) REFERENCES EffettiStato (nome) ON UPDATE CASCADE
);

-- Tabella Statistiche
CREATE TABLE Statistiche
(
    id_arma   INTEGER,                                         -- Riferimento all'arma a cui appartiene la statistica (non nullo)
    id_tipo   VARCHAR(50),                                     -- Riferimento al tipo di statistica (non nullo)
    valore    INTEGER NOT NULL,                                -- Valore della statistica (può essere nullo)
    tipologia enum ('ATT', 'DEF'),
    PRIMARY KEY (id_arma, id_tipo, tipologia),
    FOREIGN KEY (id_arma)
        REFERENCES Armi (id_arma) ON UPDATE CASCADE,           -- Vincolo per la relazione con Armi
    FOREIGN KEY (id_tipo)
        REFERENCES TipiStatistiche (id_tipo) ON UPDATE CASCADE -- Vincolo per la relazione con TipiStatistiche
);

-- Tabella Scaling
CREATE TABLE Scaling
(
    id_arma       INTEGER,                                    -- Riferimento all'arma (non nullo)
    id_attributo  VARCHAR(50),                                -- Riferimento all'attributo per il scaling (non nullo)
    grado_scaling ENUM ('A', 'B', 'C', 'D', 'E', 'S'),        -- Grado di scaling (obbligatorio)
    parametro     INTEGER,
    PRIMARY KEY (id_arma, id_attributo),
    FOREIGN KEY (id_arma)
        REFERENCES Armi (id_arma) ON UPDATE CASCADE,          -- Vincolo per la relazione con Armi
    FOREIGN KEY (id_attributo)
        REFERENCES Attributi (id_attributo) ON UPDATE CASCADE -- Vincolo per la relazione con Attributi
);

-- Tabella Utenti
CREATE TABLE Utenti
(
    Email             VARCHAR(254) PRIMARY KEY,
    Nickname          VARCHAR(20) NOT NULL UNIQUE,
    Sesso             ENUM ('M', 'F') DEFAULT 'M',
    Password          TEXT        NOT NULL,
    ProfilePicture    TEXT        NOT NULL,
    isAdmin           BOOL            DEFAULT FALSE,
    dataRegistrazione DATE        NOT NULL
);
