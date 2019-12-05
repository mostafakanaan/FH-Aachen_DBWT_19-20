USE `xcrash_db3`;

-- Tabelle loeschen, falls Sie existiert
-- Alle Tabellen, die Fremdschluessel enthalten, werden als erstes geloescht...
-- Reihenfolge beachten abhaengigkeiten muessen stimmen....
DROP TABLE IF EXISTS befreundet_mit;
DROP TABLE IF EXISTS FHAng_gehoertzu_Fachbereich;
DROP TABLE IF EXISTS Bestellung_enthaelt_Mahlzeit;
DROP TABLE IF EXISTS dek_braucht_mahlzeit;
DROP TABLE IF EXISTS Mahl_enthaelt_zutat;
DROP TABLE IF EXISTS Mahlzeit_hat_Bild;
DROP TABLE IF EXISTS Zutaten;
DROP TABLE IF EXISTS Bestellungen;
DROP TABLE IF EXISTS Kommentare;
DROP TABLE IF EXISTS Deklarationen;
DROP TABLE IF EXISTS Preise;
DROP TABLE IF EXISTS Mahlzeiten;
DROP TABLE IF EXISTS Kategorien;
-- DROP TABLE IF EXISTS Bilder;  -- Bilder in der DB lassen, sonst zu viel Aufwand
DROP TABLE IF EXISTS Fachbereiche;
DROP TABLE IF EXISTS Gaeste;
DROP TABLE IF EXISTS Mitarbeiter;
DROP TABLE IF EXISTS Studenten;
DROP TABLE IF EXISTS FH_Angehoerige;
DROP TABLE IF EXISTS Benutzer;


CREATE TABLE IF NOT EXISTS Benutzer
(
    Nummer       INT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `E-Mail`     VARCHAR(255) NOT NULL UNIQUE,    -- Backticks wegen minus im namen
    Nutzername   VARCHAR(50)  NOT NULL UNIQUE,    -- NOT NULL weil nicht optional
    Vorname      VARCHAR(70) NOT NULL,
    Nachname     VARCHAR(70) NOT NULL,
    Bild         VARBINARY(1000),
    AnlegeDatum  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Geburtsdatum DATE,
    `Alter`      INT AS (FLOOR(DATEDIFF(CURRENT_DATE, Geburtsdatum) / 365.25)),
    Aktiv        BOOL         NOT NULL DEFAULT 1,
    LetzterLogin TIMESTAMP             DEFAULT 0,
    `Hash`       VARCHAR(60)  NOT NULL,
    PRIMARY KEY (Nummer)
);

CREATE TABLE IF NOT EXISTS Bilder
(
    ID          INT UNSIGNED AUTO_INCREMENT NOT NULL,
    `Alt-Text`  VARCHAR(125)                NOT NULL,
    Titel       VARCHAR(70),
    Binaerdaten MEDIUMBLOB                  NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Kategorien
(
    ID           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Kategorie_ID INT UNSIGNED,
    Bild_ID      INT UNSIGNED,
    Bezeichnung  VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID),
    CONSTRAINT fk_kateID_bild FOREIGN KEY (Bild_ID) REFERENCES `Bilder` (ID) ON DELETE SET NULL,
    CONSTRAINT fk_mahlZeitenID_kate FOREIGN KEY (Kategorie_ID) REFERENCES `Kategorien` (ID) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS Bestellungen
(
    Nummer           INT UNSIGNED                        NOT NULL UNIQUE,
    Benutzer_Nummer  INT UNSIGNED                        NOT NULL UNIQUE,
    BestellZeitpunkt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, -- Hier musste ich die reihenfolge �ndern da es sonst zu problemen gekommen ist
    AbholZeitpunkt   TIMESTAMP CHECK (AbholZeitpunkt > BestellZeitpunkt),
    Endpreis         Double,
    PRIMARY KEY (Nummer),
    FOREIGN KEY (Benutzer_Nummer) REFERENCES `Benutzer` (nummer)
);

CREATE TABLE IF NOT EXISTS Mahlzeiten
(
    ID           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Name         VARCHAR(255) NOT NULL,
    Kategorie_ID INT UNSIGNED NOT NULL,
    Beschreibung VARCHAR(255) NOT NULL,
    Vorrat       INT UNSIGNED NOT NULL DEFAULT 0,
    Verfuegbar   BOOL DEFAULT FALSE,
    PRIMARY KEY (ID),
    FOREIGN KEY (Kategorie_ID) REFERENCES `Kategorien` (ID)
);

CREATE TABLE IF NOT EXISTS Preise
(
    Jahr          YEAR,
    Mahlzeiten_ID INT UNSIGNED NOT NULL,
    Gastpreis     DOUBLE(4, 2) UNSIGNED,
    Studentpreis  DOUBLE(4, 2) UNSIGNED CHECK ( Studentpreis < `MA-Preis`),
    `MA-Preis`    DOUBLE(4, 2) UNSIGNED,
    PRIMARY KEY (Jahr, Mahlzeiten_ID),
    CONSTRAINT fk_mahlZeitenID_preise FOREIGN KEY (Mahlzeiten_ID) REFERENCES `Mahlzeiten` (ID)
);

CREATE TABLE IF NOT EXISTS Zutaten
(
    ID          INT(5) UNSIGNED NOT NULL,
    Name        VARCHAR(255)    NOT NULL,
    Bio         BOOLEAN         NOT NULL DEFAULT FALSE,
    Vegan       BOOLEAN         NOT NULL DEFAULT FALSE,
    Glutenfrei  BOOLEAN         NOT NULL DEFAULT FALSE,
    Vegetarisch BOOLEAN         NOT NULL DEFAULT FALSE,
    PRIMARY KEY (ID)

);
CREATE TABLE IF NOT EXISTS FH_Angehoerige
(
    Nummer INT UNSIGNED NOT NULL UNIQUE,
    PRIMARY KEY (Nummer),
    FOREIGN KEY (Nummer) REFERENCES `Benutzer` (Nummer)
);

CREATE TABLE IF NOT EXISTS Studenten
(
    Nummer         INT UNSIGNED NOT NULL UNIQUE,
    Martikelnummer INT UNSIGNED NOT NULL UNIQUE CHECK (LENGTH(Martikelnummer) = 8 or LENGTH(Martikelnummer) = 9),
    Studiengang    ENUM ('ET', 'INF', 'ISE', 'MCD', 'WI'),
    PRIMARY KEY (Nummer),
    FOREIGN KEY (Nummer) REFERENCES FH_Angehoerige (Nummer) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Kommentare
(
    ID            INT UNSIGNED AUTO_INCREMENT NOT NULL,
    Mahlzeiten_ID INT UNSIGNED,
    Studenten_ID  INT UNSIGNED,
    Bemerkung     VARCHAR(255),
    Bewertung     INT(2) NOT NULL CHECK (Bewertung BETWEEN 0 AND 10),
    PRIMARY KEY (ID),
    CONSTRAINT fk_mahlZeitenID_kommentare FOREIGN KEY (Mahlzeiten_ID) REFERENCES `Mahlzeiten` (ID),
    FOREIGN KEY (Studenten_ID) REFERENCES `Studenten` (Nummer)
);

CREATE TABLE IF NOT EXISTS Mitarbeiter
(
    Nummer  INT UNSIGNED NOT NULL UNIQUE,
    Buero    VARCHAR(4),
    Telefon VARCHAR(15),
    PRIMARY KEY (Nummer),
    FOREIGN KEY (Nummer) REFERENCES FH_Angehoerige (Nummer) ON DELETE cascade

);

CREATE TABLE IF NOT EXISTS Gaeste
(
    Nummer      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Grund       VARCHAR(255) NOT NULL,
    Ablaufdatum TIMESTAMP AS (TIMESTAMPADD(WEEK, 1, CURRENT_TIMESTAMP())),
    PRIMARY KEY (Nummer),
    FOREIGN KEY (Nummer) REFERENCES `Benutzer` (Nummer) ON DELETE cascade
);

CREATE TABLE IF NOT EXISTS Fachbereiche
(
    ID      INT UNSIGNED AUTO_INCREMENT,
    Name    VARCHAR(255),
    Website VARCHAR(255),
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Deklarationen
(
    Zeichen      VARCHAR(2),
    Beschriftung VARCHAR(32),
    PRIMARY KEY (Zeichen)
);
-- N:M Relationen...

CREATE TABLE IF NOT EXISTS dek_braucht_mahlzeit
(
    Zeichen_ID    VARCHAR(2),
    Mahlzeiten_ID INT UNSIGNED NOT NULL,
    FOREIGN KEY (Zeichen_ID) REFERENCES `Deklarationen` (Zeichen),
    FOREIGN KEY (Mahlzeiten_ID) REFERENCES `Mahlzeiten` (ID)

);

CREATE TABLE IF NOT EXISTS befreundet_mit
(
    User1 INT UNSIGNED NOT NULL,
    User2 INT UNSIGNED NOT NULL,
    FOREIGN KEY (User1) REFERENCES `Benutzer` (Nummer),
    FOREIGN KEY (User2) REFERENCES `Benutzer` (Nummer)

);

CREATE TABLE IF NOT EXISTS FHAng_gehoertzu_Fachbereich
(
    Benutzer_ID     INT UNSIGNED NOT NULL,
    Fachbereiche_ID INT UNSIGNED AUTO_INCREMENT,
    FOREIGN KEY (Benutzer_ID) REFERENCES `Benutzer` (Nummer),
    FOREIGN KEY (Fachbereiche_ID) REFERENCES `Fachbereiche` (ID)
);

CREATE TABLE IF NOT EXISTS Mahl_enthaelt_zutat
(
    Mahlzeit_ID INT UNSIGNED,
    Zutat_ID    INT(5) UNSIGNED NOT NULL,
    CONSTRAINT fk_mahlZeitenID_zutat FOREIGN KEY (Mahlzeit_ID) REFERENCES `Mahlzeiten` (ID),
    FOREIGN KEY (Zutat_ID) REFERENCES `Zutaten` (ID)
);

CREATE TABLE IF NOT EXISTS Mahlzeit_hat_Bild
(
    Mahlzeiten_ID INT UNSIGNED NOT NULL,
    Bild_ID       INT UNSIGNED NOT NULL,
    FOREIGN KEY (Mahlzeiten_ID) REFERENCES `Mahlzeiten` (ID),
    FOREIGN KEY (Bild_ID) REFERENCES `Bilder` (ID)
);

CREATE TABLE IF NOT EXISTS Bestellung_enthaelt_Mahlzeit
(
    Bestell_ID  INT UNSIGNED NOT NULL,
    Mahlzeit_ID INT UNSIGNED NOT NULL,
    Anzahl      INT UNSIGNED NOT NULL,
    FOREIGN KEY (Bestell_ID) REFERENCES `Bestellungen` (Nummer),
    FOREIGN KEY (Mahlzeit_ID) REFERENCES `Mahlzeiten` (ID)
);
-- Create tables m�ssen ebenfalls die richtige reihenfolge besitzen...
-- ALTER Anweisungen

ALTER TABLE Preise
    DROP FOREIGN KEY fk_mahlZeitenID_preise;

ALTER TABLE Preise -- Preise loeschen
    ADD CONSTRAINT fk_mahlZeitenID_preise FOREIGN KEY (Mahlzeiten_ID) REFERENCES Mahlzeiten (ID) ON DELETE CASCADE;

ALTER TABLE Kommentare
    DROP FOREIGN KEY fk_mahlZeitenID_kommentare;

ALTER TABLE Kommentare -- Preise l�schen
    ADD CONSTRAINT fk_mahlZeitenID_kommentare FOREIGN KEY (Mahlzeiten_ID) REFERENCES Mahlzeiten (ID) ON DELETE SET NULL;

ALTER TABLE Mahl_enthaelt_zutat
    DROP FOREIGN KEY fk_mahlZeitenID_zutat;

ALTER TABLE Mahl_enthaelt_zutat
    ADD CONSTRAINT fk_mahlZeitenID_zutat FOREIGN KEY (Mahlzeit_ID) REFERENCES Mahlzeiten (ID) ON DELETE SET NULL;


ALTER TABLE Kategorien
    DROP FOREIGN KEY fk_mahlZeitenID_kate;

ALTER TABLE Kategorien
    ADD CONSTRAINT fk_mahlZeitenID_kate FOREIGN KEY (Kategorie_ID) REFERENCES Kategorien (ID) ON DELETE SET NULL;

ALTER TABLE Kategorien
    DROP FOREIGN KEY fk_kateID_Bild;

ALTER TABLE Kategorien
    ADD CONSTRAINT fk_kateID_bild FOREIGN KEY (Bild_ID) REFERENCES Bilder (ID) ON DELETE SET NULL;

-- INSERTS
REPLACE INTO `Benutzer`(vorname, nachname, geburtsdatum, nutzername, `E-Mail`, hash)
VALUES ('Max', 'Mustermann', '1975-01-01', 'Nutzer1', 'nutzer1@gmx.de', 'dhdazusadas');
REPLACE INTO `Benutzer`(vorname, nachname, geburtsdatum, nutzername, `E-Mail`, hash)
VALUES ('Alex', 'Leis', '1972-02-05', 'Nutzer2', 'nutzer2@gmx.de', 'dhdazusadas');
REPLACE INTO `Benutzer`(vorname, nachname, geburtsdatum, nutzername, `E-Mail`, hash)
VALUES ('Uwe', 'Kowalski', '1999-03-01', 'Nutzer3', 'nutzer3@gmx.de', 'dhdazusadas');
REPLACE INTO `Benutzer`(vorname, nachname, geburtsdatum, nutzername, `E-Mail`, hash)
VALUES ('Ralf', 'Schmidt', '1994-11-25', 'Nutzer4', 'nutzer4@gmx.de', 'dhdazusadas');

REPLACE INTO FH_Angehoerige
VALUES ((
    SELECT nummer
    FROM `Benutzer`
    WHERE `E-Mail` = 'nutzer1@gmx.de'
));
REPLACE INTO FH_Angehoerige
VALUES ((
    SELECT nummer
    FROM `Benutzer`
    WHERE `E-Mail` = 'nutzer2@gmx.de'
));
REPLACE INTO FH_Angehoerige
VALUES ((
    SELECT nummer
    FROM `Benutzer`
    WHERE `E-Mail` = 'nutzer3@gmx.de'
));

REPLACE INTO `Studenten` (Nummer, Martikelnummer, Studiengang)
VALUES ((
            SELECT nummer
            FROM `Benutzer`
            WHERE `E-Mail` = 'nutzer1@gmx.de'
        ), 12345678, 'INF');

REPLACE INTO `Studenten` (Nummer, Martikelnummer, Studiengang)
VALUES ((
            SELECT nummer
            FROM `Benutzer`
            WHERE `E-Mail` = 'nutzer2@gmx.de'
        ), 123456789, 'ET');

REPLACE INTO `Mitarbeiter`
VALUES ((
            SELECT nummer
            FROM `Benutzer`
            WHERE `E-Mail` = 'nutzer3@gmx.de'
        ), 'E113', '+49100');

-- INSERTS FOR ZUTATEN
-- --------------------------------------------------------
REPLACE INTO Zutaten
SELECT *
FROM public.zutaten;

REPLACE INTO Kategorien(ID,Kategorie_ID,Bezeichnung)
VALUES (1,NULL,'Generell'),
        (2,1,'Alle zeigen'),
        (3,NULL,'Um die Welt'),
        (4,3,'Italienisches'),
        (5,3,'Amerikanisches'),
        (6,3,'Ungarisches'),
        (7,3,'Schwedisches'),
        (8,3,'Griechisches'),
        (9,3,'Mexikanisches'),
        (10,NULL,'Saisonal');



REPLACE INTO `Mahlzeiten`(Name, Kategorie_ID, Beschreibung, Vorrat, Verfuegbar)
VALUES ('Bratrolle', '5', 'Brat mit Rolle', '0', '0'),
       ('Currywurst', '5', 'Wurst mit Curry', '10', '1'),
       ('Curry Wok', '9', 'Wok mit Curry', '10', '1'),
       ('Falafel', '9', 'Fala mit fel', '13', '1'),
       ('Käsestulle', '4', 'Stulle mit Käse', '13', '1'),
       ('Krautsalat', '4', 'Kraut mit Salat', '8', '1'),
       ('Schnitzel', '6', 'Dünne panierte gebratene Scheibe Schweinefleisch mit Beilage(Reis/Pommes).', '12', '1'),
       ('Spiegelei', '7', 'Ei mit Spiegel', '10', '1');

REPLACE INTO Mahl_enthaelt_zutat(Mahlzeit_ID,Zutat_ID)
VALUES (1,2101),
        (1,2),
        (2,2101),
        (3,999),
        (3,1010),
        (5,270),
        (5,999),
        (6,9020),
        (6,9110),
        (7,2101),
        (7,2),
        (8,1001),
        (8,2102);


REPLACE INTO `Preise`(Jahr, Mahlzeiten_ID, Gastpreis,  `MA-Preis`, Studentpreis)
VALUES ('2019', '2', '6.95', '5.95', '4.95'),
       ('2019', '1', '99.99', '98.95', '97.95'),
       ('2019', '3', '13.80', '12.95', '11.95'),
       ('2019', '4', '88.99', '85.95', '80.95'),
       ('2019', '5', '5.99', '4.95', '3.95'),
       ('2019', '6', '18.18', '17.17', '16.16'),
       ('2019', '7', '99.99', '98.95', '97.95'),
       ('2019', '8', '3.99', '2.95', '1.95');


REPLACE INTO Mahlzeit_hat_Bild(Mahlzeiten_ID, Bild_ID)
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (5, 5),
       (6, 6),
       (7, 7),
       (8, 8);